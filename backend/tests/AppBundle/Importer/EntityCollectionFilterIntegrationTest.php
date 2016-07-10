<?php

namespace AppBundle\Importer;

use AppBundle\Entity\Activity;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityCollectionFilterIntegrationTest extends WebTestCase
{
    public function testIsValidActivityEmpty()
    {
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');

        $filter = new EntityCollectionFilter($validator);
        $activity = new Activity();
        $this->assertFalse($filter->isValid($activity));
    }
}