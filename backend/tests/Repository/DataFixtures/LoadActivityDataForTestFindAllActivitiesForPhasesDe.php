<?php

namespace App\Tests\Repository\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadActivityDataForTestFindAllActivitiesForPhasesDe extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $activitiesDeOnly[] = (new Activity())->setRetromatId(1)->setPhase((0));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(2)->setPhase((1));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(3)->setPhase((2));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(4)->setPhase((3));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(5)->setPhase((4));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(6)->setPhase((5));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(7)->setPhase((0));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(8)->setPhase((1));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(9)->setPhase((2));
        $activitiesDeOnly[] = (new Activity())->setRetromatId(10)->setPhase((3));
        /** @var $activity Activity */
        foreach ($activitiesDeOnly as $activity) {
            $activity->setDefaultLocale('de');
            $activity->setName('a')->setSummary('b')->setDesc('c');
            $activity->mergeNewTranslations();
            $manager->persist($activity);
        }

        $activitiesEnOnly = [];
        $activitiesEnOnly[] = (new Activity())->setRetromatId(11)->setPhase((4));
        $activitiesEnOnly[] = (new Activity())->setRetromatId(12)->setPhase((5));
        /** @var $activity Activity */
        foreach ($activitiesEnOnly as $activity) {
            $activity->setDefaultLocale('en');
            $activity->setName('a')->setSummary('b')->setDesc('c');
            $activity->mergeNewTranslations();
            $manager->persist($activity);
        }

        $manager->flush();
    }
}
