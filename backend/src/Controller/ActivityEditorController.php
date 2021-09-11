<?php

namespace App\Controller;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivityEditorController extends AbstractController
{
    /**
     * @Route("/", name="team_activity_index", methods={"GET"})
     */
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        return $this->render(
            'activity_editor/index.html.twig',
            [
                'activity2s' => $this->findLocalizedActivities($request->getLocale())
            ]
        );
    }

    /**
     * @Route("/new", name="team_activity_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        $em = $this->getDoctrine()->getManager();
        $localizedActivities = $this->findLocalizedActivities($request->getLocale());
        $maxRetromatId = count($localizedActivities);

        if ('en' === $request->getLocale()) {
            $activity = new Activity();
            $activity->setRetromatId($maxRetromatId + 1);
            $formType = 'App\Form\ActivityType';
        } else {
            $activity = $em->getRepository('App:Activity')->findOneBy(['retromatId' => $maxRetromatId + 1]);
            $activity->setDefaultLocale($request->getLocale());

            // use English content to pre-fill translation fields
            $activity->setName($activity->translate('en')->getName());
            $activity->setSummary($activity->translate('en')->getSummary());
            $activity->setDesc($activity->translate('en')->getDesc());

            $formType = 'App\Form\ActivityTranslatableFieldsType';
        }
        $form = $this->createForm($formType, $activity);
        $form->handleRequest($request);
        // working arround weird bug: correct value 0 in request, entity ends up with null
        if (empty($activity->getPhase())) {
            $activity->setPhase(0);
        };

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->mergeNewTranslations();
            $em->persist($activity);
            $this->flushEntityManagerAndClearRedisCache();

            return $this->redirectToRoute('team_activity_show', array('id' => $activity->getId()));
        }

        return $this->render(
            'activity_editor/edit.html.twig',
            [
                'activity2' => $activity,
                'create' => true,
                'edit_form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/delete-confirm", name="team_activity_delete_confirm", methods={"GET", "POST"})
     */
    public function deleteConfirmAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        $activities = $this->findLocalizedActivities($request->getLocale());

        $lastActivity = end($activities);

        return $this->render(
            'activity_editor/deleteConfirm.html.twig',
            [
                'delete_form' => $this->createDeleteForm($lastActivity)->createView(),
                'lastActivity' => $lastActivity,
            ]
        );
    }

    /**
     * @Route("/{id}", name="team_activity_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Activity $activity)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        $form = $this->createDeleteForm($activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // this wastes a bit of RAM and a millisecond, but it is used very rarely, thus not important to optimize
            $activities = $this->findLocalizedActivities($request->getLocale());
            $lastRetromatId = end($activities)->getRetromatId();
            if ($activity->getRetromatId() === $lastRetromatId) {
                if ('en' === $request->getLocale()) {
                    $em->remove($activity);
                } else {
                    $activity->removeTranslation($activity->translate($request->getLocale(), false));
                }
                $this->flushEntityManagerAndClearRedisCache();
            }
        }

        return $this->redirectToRoute('team_activity_index');
    }

    /**
     * @Route("/{id}", name="team_activity_show", methods={"GET"})
     */
    public function showAction(Activity $activity, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        $this->get('retromat.activity_source_expander')->expandSource($activity);

        return $this->render(
            'activity_editor/show.html.twig',
            [
                'activity' => $activity,
                'ids' => [$activity->getId()],
                'phase' => '',
                'color_variation' => $this->get('retromat.color_varation'),
                'activity_by_phase' => $this->get('retromat.activity_by_phase'),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="team_activity_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Activity $activity)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        if ('en' === $request->getLocale()) {
            $formType = 'App\Form\ActivityType';
        } else {
            $formType = 'App\Form\ActivityTranslatableFieldsType';
        }
        $form = $this->createForm($formType, $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->flushEntityManagerAndClearRedisCache();

            return $this->redirectToRoute('team_activity_show', array('id' => $activity->getId()));
        }

        return $this->render(
            'activity_editor/edit.html.twig',
            [
                'activity2' => $activity,
                'create' => false,
                'edit_form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Activity $activity
     * @return FormInterface
     */
    private function createDeleteForm(Activity $activity): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('team_activity_delete', array('id' => $activity->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    private function flushEntityManagerAndClearRedisCache(): void
    {
        $this->getDoctrine()->getManager()->flush();
        $this->get('retromat.doctrine_cache.redis')->deleteAll();
    }

    /**
     * @param string $locale
     * @return array
     */
    private function findLocalizedActivities(string $locale): array
    {
        $activities = $this->getDoctrine()->getManager()->getRepository('App:Activity')->findAllOrdered();
        $localizedActivities = [];
        /** @var $activity Activity */
        foreach ($activities as $activity) {
            if (!empty($activity->translate($locale, false)->isEmpty())) {
                $localizedActivities[] = $activity;
            } else {
                break;
            }
        }

        return $localizedActivities;
    }
}
