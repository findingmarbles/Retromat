<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Activity;
use AppBundle\Importer\Activity\ActivityImporter;
use AppBundle\Importer\Activity\ActivityReader;
use AppBundle\Importer\ArrayToObjectMapper;
use AppBundle\Importer\EntityCollectionFilter;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoadActivityData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $reader = new ActivityReader($activityFileName = __DIR__.'/../../../../../lang/activities_en.php');

        $mapper = new ArrayToObjectMapper();

        /** @var ValidatorInterface $validator */
        $validator = $this->container->get('validator');

        /** @var LoggerInterface $logger */
        $logger = $this->container->get('logger');
        $filter = new EntityCollectionFilter($validator, $logger);

        $activityImporter = new ActivityImporter($reader, $mapper, $filter);
        $activities = $activityImporter->import();

        foreach ($activities as $activity) {
            $manager->persist($activity);
        }
        $manager->flush();
    }
}