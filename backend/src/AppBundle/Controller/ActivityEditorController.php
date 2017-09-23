<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activity2s = $em->getRepository('AppBundle:Activity2')->findAll();

        return $this->render('activity_editor/index.html.twig', array(
            'activity2s' => $activity2s,
        ));
    }

    /**
     * Creates a new activity2 entity.
     *
     * @Route("/new", name="team_activity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $activity2 = new Activity2();
        $form = $this->createForm('AppBundle\Form\Activity2Type', $activity2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity2);
            $em->flush();

            return $this->redirectToRoute('team_activity_show', array('id' => $activity2->getId()));
        }

        return $this->render('activity_editor/new.html.twig', array(
            'activity2' => $activity2,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activity2 entity.
     *
     * @Route("/{id}", name="team_activity_show")
     * @Method("GET")
     */
    public function showAction(Activity2 $activity2)
    {
        $deleteForm = $this->createDeleteForm($activity2);

        return $this->render('activity_editor/show.html.twig', array(
            'activity2' => $activity2,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing activity2 entity.
     *
     * @Route("/{id}/edit", name="team_activity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Activity2 $activity2)
    {
        $deleteForm = $this->createDeleteForm($activity2);
        $editForm = $this->createForm('AppBundle\Form\Activity2Type', $activity2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_activity_edit', array('id' => $activity2->getId()));
        }

        return $this->render('activity_editor/edit.html.twig', array(
            'activity2' => $activity2,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a activity2 entity.
     *
     * @Route("/{id}", name="team_activity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Activity2 $activity2)
    {
        $form = $this->createDeleteForm($activity2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activity2);
            $em->flush();
        }

        return $this->redirectToRoute('team_activity_index');
    }

    /**
     * Creates a form to delete a activity2 entity.
     *
     * @param Activity2 $activity2 The activity2 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activity2 $activity2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('team_activity_delete', array('id' => $activity2->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
