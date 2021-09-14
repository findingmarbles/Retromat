<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityEditorController extends AbstractController
{
    /**
     * @Route("/activity/editor", name="activity_editor")
     */
    public function index(): Response
    {
        return $this->render('activity_editor/index.html.twig', [
            'controller_name' => 'ActivityEditorController',
        ]);
    }
}
