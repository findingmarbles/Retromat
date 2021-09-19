<?php
declare(strict_types = 1);

namespace App\Model\Sitemap;

use App\Model\Sitemap\PlanIdGenerator;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PlanGenerator
{
    private PlanIdGenerator $planIdGenerator;

    private UrlGeneratorInterface $urlGenerator;

    private UrlContainerInterface $urlContainer;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param PlanIdGenerator $planIdGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, PlanIdGenerator $planIdGenerator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->planIdGenerator = $planIdGenerator;
    }

    /**
     * @param UrlContainerInterface $urlContainer
     */
    public function populatePlans(UrlContainerInterface $urlContainer)
    {
        // Maybe move urlContainer and addToUrlContainer() to a separate collector object later.
        $this->urlContainer = $urlContainer;
        $this->planIdGenerator->generate([$this, 'addToUrlContainer']);
    }

    /**
     * @param string $id
     * Maybe move urlContainer and addToUrlContainer() to a separate collector object later.
     */
    public function addToUrlContainer(string $id)
    {
        $this->urlContainer->addUrl(
            new UrlConcrete(
                $this->urlGenerator->generate(
                    'activities_by_id',
                    [
                        'id' => $id,
                        '_locale' => 'en',
                    ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ),
            'plan'
        );
    }
}
