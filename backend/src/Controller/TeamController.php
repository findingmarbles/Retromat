<?php

namespace App\Controller;

use App\Model\Plan\DescriptionRenderer;
use App\Model\Plan\Exception\InconsistentInputException;
use App\Model\Plan\TitleChooser;
use App\Model\Plan\TitleIdGenerator;
use App\Model\Sitemap\PlanIdGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}/team")
 * @Security("has_role('ROLE_TRANSLATOR')")
 */
class TeamController extends AbstractController
{
    private $ids = [];

    private PlanIdGenerator $planIdGenerator;

    private TitleIdGenerator $titleIdGenerator;

    private TitleChooser $titleChooser;

    private DescriptionRenderer $descriptionRenderer;

    public function __construct(
        PlanIdGenerator $planIdGenerator,
        TitleIdGenerator $titleIdGenerator,
        TitleChooser $titleChooser,
        DescriptionRenderer $descriptionRenderer
    ) {
        $this->planIdGenerator = $planIdGenerator;
        $this->titleIdGenerator = $titleIdGenerator;
        $this->titleChooser = $titleChooser;
        $this->descriptionRenderer = $descriptionRenderer;
    }

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
     * @throws InconsistentInputException
     */
    public function serpPreviewAction(Request $request)
    {
        $this->planIdGenerator->generate([$this, 'collect'], (int)$request->get('max'), (int)$request->get('skip'));
        $totalCombinations = $this->titleIdGenerator->countCombinationsInAllSequences(
            $request->getLocale()
        );

        $activityRepository = $this->getDoctrine()
            ->getRepository('App:Activity');

        return $this->render(
            'team/experiment/titlesAndDescriptionsByPlanId.html.twig',
            [
                'planIds' => $this->ids,
                'titleChooser' => $this->titleChooser,
                'descriptionRenderer' => $this->descriptionRenderer,
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

        $message = (new Swift_Message($subject))
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
