<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/{_locale}/team")
 * @Security("has_role('ROLE_ADMIN')")
 */
class TeamController extends Controller
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
     * @Route("/experiment/titles", name="titles-experiment")
     */
    public function titlesExperimentAction()
    {
        return $this->render('team/experiment/titles.html.twig');
    }

    /**
     * @Route("/experiment/titles/sequence/{sequenceId}", name="titles-experiment-sequence")
     */
    public function titlesExperimentBySequenceAction($sequenceId)
    {
        $titleParts = $this->getParameter('retromat.plan.titles');
        $generator = $this->get('retromat.plan.title_id_generator');

        return $this->render(
            'team/experiment/titlesBySequence.html.twig',
            [
                'title_renderer' => $this->get('retromat.plan.title_renderer'),
                'totalCombinations' => $generator->countCombinationsInAllSequences(),
                'ids' => $generator->generateIds($sequenceId),
                'titleParts' => $titleParts,
                'sequenceId' => $sequenceId,
                'combinationsInSequence' => $generator->countCombinationsInSequence($sequenceId),
            ]
        );
    }

    /**
     * @Route("/experiment/titles/by-plan-id", name="titles-experiment-planids")
     */
    public function titlesExperimentByPlanId(Request $request)
    {
        $planIdGenerator = $this->get('retromat.plan.plan_id_generator');
        $planIdGenerator->generate([$this, 'collect'], (int)$request->get('max'), (int)$request->get('skip'));
        $totalCombinations = $this->get('retromat.plan.title_id_generator')->countCombinationsInAllSequences();

        return $this->render(
            'team/experiment/titlesByPlanId.html.twig',
            [
                'planIds' => $this->ids,
                'titleChooser' => $titleChooser = $this->get('retromat.plan.title_chooser'),
                'descriptionRenderer' => $this->get('retromat.plan.description_renderer'),
                'totalCombinations' => $totalCombinations,
            ]
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

    /**
     * @param string $id
     */
    public function collect(string $id)
    {
        $this->ids[] = $id;
    }
}