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
     * @Route("/dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('team/dashboard/dashboard.html.twig');
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