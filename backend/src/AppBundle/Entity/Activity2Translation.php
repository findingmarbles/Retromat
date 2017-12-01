<?php
declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Activity2Translation
 *
 * @ORM\Table(name="activity2translation")
 * @ORM\Entity
 */
class Activity2Translation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * Using `backticks` to avoid mysql reserved keyword https://dev.mysql.com/doc/refman/5.5/en/keywords.html
     * @ORM\Column(name="`name`", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary;

    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * Using `backticks` to avoid mysql reserved keyword https://dev.mysql.com/doc/refman/5.5/en/keywords.html
     * @ORM\Column(name="`desc`", type="text")
     */
    private $desc;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Activity2Translation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Activity2Translation
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set desc
     *
     * @param string $desc
     *
     * @return Activity2Translation
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get desc
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }
}
