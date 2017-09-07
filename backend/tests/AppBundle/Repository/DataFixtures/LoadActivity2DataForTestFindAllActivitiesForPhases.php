<?php

namespace tests\AppBundle\Repository\DataFixtures;

use AppBundle\Entity\Activity2;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadActivity2DataForTestFindAllActivitiesForPhases implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activities[] = (new Activity2())->setRetromatId(1)->setPhase((0));
        $activities[] = (new Activity2())->setRetromatId(2)->setPhase((1));
        $activities[] = (new Activity2())->setRetromatId(3)->setPhase((2));
        $activities[] = (new Activity2())->setRetromatId(4)->setPhase((3));
        $activities[] = (new Activity2())->setRetromatId(5)->setPhase((4));
        $activities[] = (new Activity2())->setRetromatId(6)->setPhase((5));
        $activities[] = (new Activity2())->setRetromatId(7)->setPhase((0));
        $activities[] = (new Activity2())->setRetromatId(8)->setPhase((1));
        $activities[] = (new Activity2())->setRetromatId(9)->setPhase((2));
        $activities[] = (new Activity2())->setRetromatId(10)->setPhase((3));
        $activities[] = (new Activity2())->setRetromatId(11)->setPhase((4));
        $activities[] = (new Activity2())->setRetromatId(12)->setPhase((5));

        foreach ($activities as $activity) {
            $activity->setName('foo')->setSummary('foo')->setDesc('foo');
            $manager->persist($activity);
        }
        $manager->flush();
    }
}