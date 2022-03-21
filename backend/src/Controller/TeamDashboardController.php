<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('{_locale}/team')]
class TeamDashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'team_dashboard', methods: ['GET'])]
    public function dashboardAction()
    {
        return $this->render('team/dashboard/dashboard.html.twig');
    }
}
