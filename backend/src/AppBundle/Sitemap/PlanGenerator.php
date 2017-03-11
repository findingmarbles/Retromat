<?php
declare(strict_types = 1);

namespace AppBundle\Sitemap;

use AppBundle\Plan\PlanIdGenerator;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PlanGenerator
{
    /**
     * @var PlanIdGenerator
     */
    private $idGenerator;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var UrlContainerInterface
     * Maybe move urlContainer and addToUrlContainer() to a separate collector object later.
     */
    private $urlContainer;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param PlanIdGenerator $idGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, PlanIdGenerator $idGenerator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->idGenerator = $idGenerator;
    }

    /**
     * @param UrlContainerInterface $urlContainer
     */
    public function populatePlans(UrlContainerInterface $urlContainer)
    {
        // Maybe move urlContainer and addToUrlContainer() to a separate collector object later.
        $this->urlContainer = $urlContainer;
        $this->idGenerator->generateAll([$this, 'addToUrlContainer']);
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