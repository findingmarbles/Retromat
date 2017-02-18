<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ExperimentController extends Controller
{
    /**
     * @Route("/{_locale}/inside/experiment/email")
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

        return $this->render('inside/experiment/emailExperiment.html.twig', ['subject' => $subject]);
    }
}