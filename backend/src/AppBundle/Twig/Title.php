<?php
declare(strict_types = 1);

namespace AppBundle\Twig;

use AppBundle\Twig\Exception\InconsistentInputException;

class Title
{
    /**
     * @var array
     */
    private $parts = [];

    /**
     * Title constructor.
     * @param array $parts
     */
    function __construct(array $parts)
    {
        $this->parts = $parts;
    }

    /**
     * @param $idString
     * @return string
     * @throws InconsistentInputException
     */
    public function render($idString)
    {
        $idStringParts = explode(':', $idString);
        $sequenceOfGroups = $this->parts['sequence_of_groups'][$idStringParts[0]];
        $fragmentIds = explode('-', $idStringParts[1]);
        unset($idString, $idStringParts);

        if (count($fragmentIds) != count($sequenceOfGroups)) {
            throw new InconsistentInputException(
                'Number of frament ids differs from number of groups in the sequence of groups. They need to be equal.'
            );
        }

        $fragments = [];
        for ($i = 0; $i < count($fragmentIds); $i++) {
            $fragments[] = $this->parts['groups_of_terms'][$sequenceOfGroups[$i]][$fragmentIds[$i]];
        }

        return implode(' ', $fragments);
    }
}