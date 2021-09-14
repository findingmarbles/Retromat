<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}/team")
 * @Security("has_role('ROLE_TRANSLATOR')")
 */
class TeamController extends AbstractController
{
    private $ids = [];

    /**
     * @Route("/dashboard", name="team_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('team/dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/experiment/titles-descriptions/by-plan-id", name="titles-descriptions-experiment")
     * @Security("has_role('ROLE_SERP_PREVIEW')")
     * @throws \AppBundle\Plan\Exception\InconsistentInputException
     */
    public function serpPreviewAction(Request $request)
    {
        $planIdGenerator = $this->get('retromat.plan.plan_id_generator');
        $planIdGenerator->generate([$this, 'collect'], (int)$request->get('max'), (int)$request->get('skip'));
        $totalCombinations = $this->get('retromat.plan.title_id_generator')->countCombinationsInAllSequences(
            $request->getLocale()
        );

        $activityRepository = $this->getDoctrine()
            ->getRepository('App:Activity');

        return $this->render(
            'team/experiment/titlesAndDescriptionsByPlanId.html.twig',
            [
                'planIds' => $this->ids,
                'titleChooser' => $this->get('retromat.plan.title_chooser'),
                'descriptionRenderer' => $this->get('retromat.plan.description_renderer'),
                'totalCombinations' => $totalCombinations,
                'activityRepository' => $activityRepository,
            ]
        );
    }

    /**
     * @Route("/experiment/email")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function emailExperimentAction()
    {
        $subject = '[retomat-backend] Email Experiment';

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->getParameter('retromat_backend_mail'))
            ->setTo($this->getParameter('retromat_backend_mail'))
            ->setBody(
                'Email Experiment',
                'text/plain'
            );
        $this->get('mailer')->send($message);

        return $this->render('team/experiment/emailExperiment.html.twig', ['subject' => $subject]);
    }

    /**
     * @Route("/experiment/error")
     * @Security("has_role('ROLE_ADMIN')")
     * @throws \Exception
     */
    public function errorExperimentAction()
    {
        throw new \Exception('The ErrorExperiment has been triggered.');
    }

    /**
     * @param string $id
     */
    public function collect(string $id)
    {
        $this->ids[] = $id;
    }
}
