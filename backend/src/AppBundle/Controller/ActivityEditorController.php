<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Entity\Activity2;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Activity2 controller.
 *
 * @Route("{_locale}/team/activity")
 */
class ActivityEditorController extends Controller
{
    /**
     * Lists all activity2 entities.
     *
     * @Route("/", name="team_activity_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        return $this->render(
            'activity_editor/index.html.twig',
            ['activity2s' => $this->findLocalizedActivities($request->getLocale())]
        );
    }

    /**
     * Creates a new activity2 entity.
     *
     * @Route("/new", name="team_activity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        $em = $this->getDoctrine()->getManager();
        $localizedActivities = $this->findLocalizedActivities($request->getLocale());
        $maxRetromatId = count($localizedActivities);

        if ('en' === $request->getLocale()) {
            $activity = new Activity2();
            $activity->setRetromatId($maxRetromatId + 1);
            $formType = 'AppBundle\Form\Activity2Type';
        } else {
            $activity = $em->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => $maxRetromatId + 1]);
            $activity->setDefaultLocale($request->getLocale());

            // use English content to pre-fill translation fields
            $activity->setName($activity->translate('en')->getName());
            $activity->setSummary($activity->translate('en')->getSummary());
            $activity->setDesc($activity->translate('en')->getDesc());

            $formType = 'AppBundle\Form\Activity2TranslatableFieldsType';
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
     * Asks for confirmation to delete the last activity2 entity.
     *
     * @Route("/delete-confirm", name="team_activity_delete_confirm")
     * @Method({"GET"})
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
     * Deletes a activity2 entity.
     *
     * @Route("/{id}", name="team_activity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Activity2 $activity)
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
     * Finds and displays a activity2 entity.
     *
     * @Route("/{id}", name="team_activity_show")
     * @Method("GET")
     */
    public function showAction(Activity2 $activity, Request $request)
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
     * Displays a form to edit an existing activity2 entity.
     *
     * @Route("/{id}/edit", name="team_activity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Activity2 $activity)
    {
        $this->denyAccessUnlessGranted('ROLE_TRANSLATOR_'.strtoupper($request->getLocale()));

        if ('en' === $request->getLocale()) {
            $formType = 'AppBundle\Form\Activity2Type';
        } else {
            $formType = 'AppBundle\Form\Activity2TranslatableFieldsType';
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
     * Creates a form to delete a activity2 entity.
     *
     * @param Activity2 $activity The activity2 entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(Activity2 $activity)
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
        $activities = $this->getDoctrine()->getManager()->getRepository('AppBundle:Activity2')->findAllOrdered();
        $localizedActivities = [];
        /** @var $activity Activity2 */
        foreach ($activities as $activity) {
            if (!empty($activity->translate($locale, false)->getId())) {
                $localizedActivities[] = $activity;
            } else {
                break;
            }
        }

        return $localizedActivities;
    }
}
