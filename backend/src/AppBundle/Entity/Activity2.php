<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Activity2
 *
 * @ORM\Table(name="activity2",
 *     indexes={
 *          @ORM\Index(name="retromatId_index2", columns={"retromat_id"}),
 *          @ORM\Index(name="phase_index2", columns={"phase"})}
 *     )
 * @ORM\Entity
 */
class Activity2
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * Internal id used by the Doctine ORM.
     * Coloumn + property name both need to be "id" for the Translatable trait.
     *
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * $retromatId is the public ID as in http://plans-for-retrospectives.com/?id=123
     * this differs by -1 from the internal ID in JS code, e.g. all_activities[122]
     *
     * @var int
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     * @ORM\Column(name="retromat_id", type="smallint", unique=true)
     */
    private $retromatId;

    /**
     * @var int
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     * @Assert\Range(min = 0, max = 5)
     * Using `backticks` to avoid mysql reserved keyword https://dev.mysql.com/doc/refman/5.5/en/keywords.html
     * @ORM\Column(name="`phase`", type="smallint")
     */
    private $phase;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="source", type="text", nullable=true)
     */
    private $source;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="more", type="text", nullable=true)
     */
    private $more;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="suitable", type="string", length=255, nullable=true)
     */
    private $suitable;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set retromatId
     *
     * @param integer $retromatId
     *
     * @return Activity2
     */
    public function setRetromatId($retromatId): Activity2
    {
        $this->retromatId = $retromatId;

        return $this;
    }

    /**
     * Get retromatId
     *
     * @return int
     */
    public function getRetromatId(): int
    {
        return $this->retromatId;
    }

    /**
     * Set phase
     *
     * @param integer $phase
     *
     * @return Activity2
     */
    public function setPhase($phase): Activity2
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * Get phase
     *
     * @return int
     */
    public function getPhase(): int
    {
        return $this->phase;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Activity2
     */
    public function setDuration($duration): Activity2
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Activity2
     */
    public function setSource($source): Activity2
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Set more
     *
     * @param string $more
     *
     * @return Activity2
     */
    public function setMore($more): Activity2
    {
        $this->more = $more;

        return $this;
    }

    /**
     * Get more
     *
     * @return string
     */
    public function getMore(): string
    {
        return $this->more;
    }

    /**
     * Set suitable
     *
     * @param string $suitable
     *
     * @return Activity2
     */
    public function setSuitable($suitable): Activity2
    {
        $this->suitable = $suitable;

        return $this;
    }

    /**
     * Get suitable
     *
     * @return string
     */
    public function getSuitable(): string
    {
        return $this->suitable;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->retromatId;
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}