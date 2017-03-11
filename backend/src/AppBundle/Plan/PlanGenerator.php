<?php

namespace AppBundle\Plan;

use AppBundle\Entity\Plan;
use Doctrine\Common\Persistence\ObjectManager;

class PlanGenerator
{
    private $planIdGenerator;

    private $objectManager;

    public function __construct(PlanIdGenerator $planIdGenerator, ObjectManager $objectManager)
    {
        $this->planIdGenerator = $planIdGenerator;
        $this->objectManager = $objectManager;
    }

    public function generateAll()
    {
        $objectManager = $this->objectManager;
        $createAndPersist = function ($id) use ($objectManager) {
            $plan = (new Plan())->setLanguage('en')->setRetromatId($id)->setTitleId('0:0-0-0-0-0-0-0-0-0-0');
            $objectManager->persist($plan);
            $objectManager->flush($plan);
            $objectManager->detach($plan);
        };

        $this->planIdGenerator->generate($createAndPersist);
    }
}