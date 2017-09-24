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
     * @Route("/new", name="team_activity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lastActivityId = count($em->getRepository('AppBundle:Activity2')->findAllOrdered());

        $activity = new Activity2();
        $activity->setRetromatId($lastActivityId + 1);
        $form = $this->createForm('AppBundle\Form\Activity2Type', $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->mergeNewTranslations();
            $em->persist($activity);
            $em->flush();

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
        $deleteForm = $this->createDeleteForm($activity);

        return $this->render(
            'activity_editor/show.html.twig',
            array(
                'activity2' => $activity,
                'delete_form' => $deleteForm->createView(),
            )
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
            $this->getDoctrine()->getManager()->flush();

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
            $em->flush();
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
}
