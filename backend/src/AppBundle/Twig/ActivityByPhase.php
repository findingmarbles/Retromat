<?php

namespace AppBundle\Twig;

class ActivityByPhase
{
    private $activityByPhase;

    /**
     * ActivityByPhase constructor.
     */
    public function __construct()
    {
        $this->activityByPhase = [

            // !! need to be nested arrays instead of strings !!

            '0' => '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122',
            '1' => '4-5-6-7-19-33-35-47-51-54-62-64-65-75-78-79-80-86-87-89-93-97-98-110-116-119-121-123',
            '2' => '8-9-10-20-25-26-37-41-50-55-58-66-68-69-74-91-94-95-105-113-115-118',
            '3' => '11-12-13-21-24-29-38-39-48-49-61-63-72-73-88-96-99-100-103-117-124-125',
            '4' => '14-15-16-17-23-34-40-44-45-53-57-60-67-71-77-83-92-101-102-104-109-112-120',
            '5' => '27-28-30-56-111',
        ];
    }

    public function getAllActivitiesByPhase()
    {
        return $this->activityByPhase;
    }
}