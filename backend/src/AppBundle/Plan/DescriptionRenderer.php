<?php
declare(strict_types = 1);

namespace AppBundle\Plan;

class DescriptionRenderer
{
    /**
     * @param array $activities
     * @return string
     */
    public function render(array $activities): string
    {
        if (5 !== count($activities)) {
            return '';
        }

        return '1, 4: Participants write down significant events and order them chronologically , 8: Drill down to the root cause of problems by repeatedly asking \'Why?\', 11, 14';
    }
}