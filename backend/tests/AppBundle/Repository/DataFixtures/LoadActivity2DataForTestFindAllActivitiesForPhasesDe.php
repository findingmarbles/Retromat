<?php

namespace tests\AppBundle\Repository\DataFixtures;

use AppBundle\Entity\Activity2;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadActivity2DataForTestFindAllActivitiesForPhasesDe implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(1)->setPhase((0));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(2)->setPhase((1));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(3)->setPhase((2));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(4)->setPhase((3));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(5)->setPhase((4));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(6)->setPhase((5));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(7)->setPhase((0));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(8)->setPhase((1));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(9)->setPhase((2));
        $activitiesDeOnly[] = (new Activity2())->setRetromatId(10)->setPhase((3));
        /** @var $activity Activity2 */
        foreach ($activitiesDeOnly as $activity) {
            $activity->setDefaultLocale('de');
            $activity->setName('a')->setSummary('b')->setDesc('c');
            $activity->mergeNewTranslations();
            $manager->persist($activity);
        }

        $activitiesEnOnly = [];
        $activitiesEnOnly[] = (new Activity2())->setRetromatId(11)->setPhase((4));
        $activitiesEnOnly[] = (new Activity2())->setRetromatId(12)->setPhase((5));
        /** @var $activity Activity2 */
        foreach ($activitiesEnOnly as $activity) {
            $activity->setDefaultLocale('en');
            $activity->setName('a')->setSummary('b')->setDesc('c');
            $activity->mergeNewTranslations();
            $manager->persist($activity);
        }

        $manager->flush();
    }
}