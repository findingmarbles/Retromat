<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Activity2;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Activity2 controller.
 *
 * @Route("{_locale}/team/activity")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ActivityEditorController extends Controller
{
    /**
     * Lists all activity2 entities.
     *
     * @Route("/", name="team_activity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activities = $em->getRepository('AppBundle:Activity2')->findAll();

        return $this->render(
            'activity_editor/index.html.twig',
            array(
                'activity2s' => $activities,
            )
        );
    }

    /**
     * Creates a new activity2 entity.
     *
     * @Route("/new", requirements={"_locale": "en"}, name="team_activity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // this wastes a bit of RAM and a millisecond, but it is used very rarely, thus not important to optimize
        $nextRetromatId = count($em->getRepository('AppBundle:Activity2')->findAllOrdered())+1;

        $activity = new Activity2();
        $activity->setRetromatId($nextRetromatId);
        $form = $this->createForm('AppBundle\Form\Activity2Type', $activity);
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
            'activity_editor/new.html.twig',
            array(
                'activity2' => $activity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a activity2 entity.
     *
     * @Route("/{id}", name="team_activity_show")
     * @Method("GET")
     */
    public function showAction(Activity2 $activity)
    {
        return $this->render(
            'activity_editor/show.html.twig',
            [
                'activity' => $activity,
                'ids' => [$activity->getId()],
                'phase' => '',
                'color_variation' => $this->get('retromat.color_varation'),
                'activity_by_phase' => $this->get('retromat.activity_by_phase'),
                'activity_source' => $this->getParameter('retromat.activity.source'),
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
        $deleteForm = $this->createDeleteForm($activity);
        $editForm = $this->createForm('AppBundle\Form\Activity2Type', $activity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->flushEntityManagerAndClearRedisCache();

            return $this->redirectToRoute('team_activity_show', array('id' => $activity->getId()));
        }

        return $this->render(
            'activity_editor/edit.html.twig',
            array(
                'activity2' => $activity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
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
        $form = $this->createDeleteForm($activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activity);
            $this->flushEntityManagerAndClearRedisCache();
        }

        return $this->redirectToRoute('team_activity_index');
    }

    /**
     * Creates a form to delete a activity2 entity.
     *
     * @param Activity2 $activity The activity2 entity
     *
     * @return \Symfony\Component\Form\Form The form
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
}
