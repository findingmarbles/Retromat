<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityTranslatableFieldsType;
use App\Form\ActivityType;
use App\Model\Activity\ActivityByPhase;
use App\Model\Activity\Expander\ActivityExpander;
use App\Model\Activity\Localizer\ActivityLocalizer;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

#[Route('{_locale}/team/activity')]
class TeamActivityController extends AbstractController
{
    private ActivityExpander $activityExpander;
    private ActivityByPhase $activityByPhase;
    private CacheInterface $doctrineResultCachePool;
    private EntityManagerInterface $entityManager;
    private ActivityLocalizer $activityLocalizer;
    private ActivityRepository $activityRepository;

    public function __construct(
        ActivityExpander $activityExpander,
        ActivityByPhase $activityByPhase,
        CacheInterface $doctrineResultCachePool,
        EntityManagerInterface $entityManager,
        ActivityLocalizer $activityLocalizer,
        ActivityRepository $activityRepository,
    ) {
        $this->activityExpander = $activityExpander;
        $this->activityByPhase = $activityByPhase;
        $this->doctrineResultCachePool = $doctrineResultCachePool;
        $this->entityManager = $entityManager;
        $this->activityLocalizer = $activityLocalizer;
        $this->activityRepository = $activityRepository;
    }

    #[Route('/', name: 'team_activity_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        return $this->render('team/activity/index.html.twig', [
            'activities' => $this->activityLocalizer->localize(
                $this->activityRepository->findAllOrdered(),
                $request->getLocale()
            ),
        ]);
    }

    #[Route('/new', name: 'team_activity_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.\strtoupper($request->getLocale()));

        $activity = $this->createActivity($request->getLocale());
        $form = $this->createActivityForm($request->getLocale(), $activity);
        $form->handleRequest($request);

        if (empty($activity->getPhase())) {
            $activity->setPhase(0);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->mergeNewTranslations();
            $this->entityManager->persist($activity);
            $this->entityManager->flush();
            $this->doctrineResultCachePool->clear();

            $this->addFlash('success', 'Successfully saved new activity record.');

            return $this->redirectToRoute('team_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('team/activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'team_activity_show', methods: ['GET'])]
    public function show(Request $request, Activity $activity): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.\strtoupper($request->getLocale()));

        $this->activityExpander->expandSource($activity);

        return $this->render('team/activity/show.html.twig', [
            'activity' => $activity,
        ]);
    }

    #[Route('/{id}/edit', name: 'team_activity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activity $activity): Response
    {
        $form = $this->createActivityForm($request->getLocale(), $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->doctrineResultCachePool->clear();

            $this->addFlash('success', 'Successfully updated activity record.');

            return $this->redirectToRoute('team_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('team/activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'team_activity_delete', methods: ['POST'])]
    public function delete(Request $request, Activity $activity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($activity);
            $this->entityManager->flush();
            $this->addFlash('success', 'Successfully deleted activity record.');
        }

        return $this->redirectToRoute('team_activity_index', [], Response::HTTP_SEE_OTHER);
    }

    private function createActivity(string $locale): Activity
    {
        $localizedActivities = $this->activityLocalizer->localize(
            $this->activityRepository->findAllOrdered(),
            $locale
        );

        if ('en' === $locale) {
            $activity = new Activity();
            $activity->setRetromatId(\count($localizedActivities) + 1);
        } else {
            $activity = $this->activityRepository->findOneBy(['retromatId' => \count($localizedActivities) + 1]);
            $activity->setDefaultLocale($locale);
            $activity->setName($activity->translate('en')->getName());
            $activity->setSummary($activity->translate('en')->getSummary());
            $activity->setDesc($activity->translate('en')->getDesc());
        }

        return $activity;
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function createActivityForm(string $locale, ?Activity $activity = null, array $options = []): FormInterface
    {
        if ('en' === $locale) {
            $type = ActivityType::class;
        } else {
            $type = ActivityTranslatableFieldsType::class;
        }

        return $this->container->get('form.factory')->create($type, $activity, $options);
    }
}
