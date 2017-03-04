<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/{_locale}/team")
 * @Security("has_role('ROLE_ADMIN')")
 */
class TeamController extends Controller
{
    /**
     * @Route("/dashboard", name="team_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('team/dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/experiment/titles", name="titles-experiment")
     */
    public function titlesExperimentAction()
    {
        $titles = $this->getParameter('retromat.plan.titles');
        $totalCombinations = $this->get('retromat.plan.title_id_generator')->countCombinationsInAllSequences();

        return $this->render(
            'team/experiment/titles.html.twig',
            ['titles' => $titles, 'totalCombinations' => $totalCombinations]
        );
    }

    /**
     * @Route("/experiment/titles/all-ids", name="titles-experiment-all-ids")
     */
    public function titlesExperimentAllIdsAction()
    {
        return $this->render(
            'team/experiment/titlesAllIds.html.twig',
            ['allIds' => $this->get('retromat.plan.title_id_generator')->generateIdsForAllSequences()]
        );
    }

    /**
     * @Route("/experiment/email")
     */
    public function emailExperimentAction()
    {
        $subject = '[retomat-backend] Email Experiment';

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('retromat-backend@avior.uberspace.de')
            ->setTo('retromat-backend@avior.uberspace.de')
            ->setBody(
                'Email Experiment',
                'text/plain'
            );
        $this->get('mailer')->send($message);

        return $this->render('team/experiment/emailExperiment.html.twig', ['subject' => $subject]);
    }

    /**
     * @Route("/experiment/error")
     */
    public function errorExperimentAction()
    {
        throw new \Exception('The ErrorExperiment has been triggered.');
    }
}