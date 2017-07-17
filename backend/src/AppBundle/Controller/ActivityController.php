<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;

class ActivityController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($slug)
    {
    }

    public function cgetAction()
    {
    }
}