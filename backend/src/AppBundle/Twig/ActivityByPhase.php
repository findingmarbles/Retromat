<?php

namespace AppBundle\Twig;

use Doctrine\ORM\EntityManagerInterface;

class ActivityByPhase
{
    private $activityByPhase;
    private $entityManager;

    /**
     * ActivityByPhase constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllActivitiesByPhase()
    {
        $this->lazyInit();

        return $this->activityByPhase;
    }

    public function getActivitiesString($phase)
    {
        $this->lazyInit();

        return implode('-', $this->activityByPhase[$phase]);
    }

    public function nextActivityIdInPhase($phase, $id)
    {
        $this->lazyInit();
        $idKey = array_search($id, $this->activityByPhase[$phase]);

        // if we are on the last activity of the phase, the next one is the first
        if ($idKey == count($this->activityByPhase[$phase]) - 1) {
            return $this->activityByPhase[$phase][0];
        }

        return $this->activityByPhase[$phase][$idKey + 1];
    }

    public function previousActivityIdInPhase($phase, $id)
    {
        $this->lazyInit();
        $idKey = array_search($id, $this->activityByPhase[$phase]);

        // if we are on the first activity of the phase, the previous one is the last
        if (0 == $idKey) {
            return $this->activityByPhase[$phase][count($this->activityByPhase[$phase]) - 1];
        }

        return $this->activityByPhase[$phase][$idKey - 1];
    }

    public function nextIds(array $ids, $id, $phase)
    {
        $idKey = array_search($id, $ids);
        $ids[$idKey] = $this->nextActivityIdInPhase($phase, $id);

        return $ids;
    }

    public function previousIds(array $ids, $id, $phase)
    {
        $idKey = array_search($id, $ids);
        $ids[$idKey] = $this->previousActivityIdInPhase($phase, $id);

        return $ids;
    }

    /**
     * http://www.martinfowler.com/bliki/LazyInitialization.html
     */
    private function lazyInit()
    {
        if (!isset($this->activityByPhase)) {
            $this->activityByPhase = $this->entityManager->getRepository('AppBundle:Activity')->findAllActivitiesByPhases();
        }
    }
}