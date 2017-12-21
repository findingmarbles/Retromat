<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/{_locale}/team")
 * @Security("has_role('ROLE_TRANSLATOR')")
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
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function titlesExperimentAction()
    {
        return $this->render('team/experiment/titles.html.twig');
    }

    /**
     * @Route("/experiment/titles-descriptions/by-plan-id", name="titles-descriptions-experiment")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function titlesAndDescriptionsExperimentByPlanId(Request $request)
    {
        $planIdGenerator = $this->get('retromat.plan.plan_id_generator');
        $planIdGenerator->generate([$this, 'collect'], (int)$request->get('max'), (int)$request->get('skip'));
        $totalCombinations = $this->get('retromat.plan.title_id_generator')->countCombinationsInAllSequences();
        $activityRepository = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2');

        return $this->render(
            'team/experiment/titlesAndDescriptionsByPlanId.html.twig',
            [
                'planIds' => $this->ids,
                'titleChooser' => $titleChooser = $this->get('retromat.plan.title_chooser'),
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

    /**
     * @Route("/experiment/cache-counter", name="cache-counter-experiment")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function cacheExperimentAction()
    {
        $cache = $this->get('cache.app');
        $cachedCounter = $cache->getItem('experiment.counter');
        if (!$cachedCounter->isHit()) {
            $counter = 0;

            $cachedCounter->set($counter);
            $cache->save($cachedCounter);
        } else {
            $counter = $cachedCounter->get();

            $counter++;

            $cachedCounter->set($counter);
            $cache->save($cachedCounter);
        }

        return $this->render('team/experiment/cacheCounter.html.twig', ['counter' => $counter]);
    }
}