<?php

declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class StaticPageController extends AbstractController
{
    #[Cache(public: true, maxage: 3600, smaxage: 84600)]
    public function staticPageAction(string $template): Response
    {
        return $this->render($template);
    }
}
