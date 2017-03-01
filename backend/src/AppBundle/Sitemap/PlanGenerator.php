<?php

namespace AppBundle\Sitemap;

use Doctrine\Common\Persistence\ObjectManager;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PlanGenerator
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ObjectManager $objectManager
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param UrlContainerInterface $urlContainer
     */
    public function populatePlans(UrlContainerInterface $urlContainer, array $activitiesByPhase, $language)
    {
        // @todo investigate if id generation can be replaced by AppBundle\Plan\PlanIdGenerator -> generateAll() + callback

        foreach ($activitiesByPhase[4] as $id4) {
            foreach ($activitiesByPhase[3] as $id3) {
                foreach ($activitiesByPhase[2] as $id2) {
                    foreach ($activitiesByPhase[1] as $id1) {
                        foreach ($activitiesByPhase[0] as $id0) {
                            $urlContainer->addUrl(
                                new UrlConcrete(
                                    $this->urlGenerator->generate(
                                        'activities_by_id',
                                        [
                                            'id' => $id0.'-'.$id1.'-'.$id2.'-'.$id3.'-'.$id4,
                                            '_locale' => $language,
                                        ],
                                        UrlGeneratorInterface::ABSOLUTE_URL
                                    )
                                ),
                                'plan'
                            );
                        }
                    }
                }
            }
        }
    }
}