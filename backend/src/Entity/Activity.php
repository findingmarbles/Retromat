<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 * @ORM\Table(name="activity",
 *     indexes={
 *          @ORM\Index(name="retromatId_index2", columns={"retromat_id"}),
 *          @ORM\Index(name="phase_index2", columns={"phase"})}
 *     )
 */
class Activity implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * $retromatId is the public ID as in https://retromat.org/?id=123
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
     * @Assert\Range(min = 0, max = 5)
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
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="stage", type="string", length=255, nullable=true)
     */
    private $stage;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="forum_url", type="text", nullable=true)
     */
    private $forumUrl;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $retromatId
     * @return $this
     */
    public function setRetromatId($retromatId): self
    {
        $this->retromatId = $retromatId;

        return $this;
    }

    /**
     * @return int
     */
    public function getRetromatId(): int
    {
        return (int)$this->retromatId;
    }

    /**
     * @param $phase
     * @return $this
     */
    public function setPhase($phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * @return int
     */
    public function getPhase(): int
    {
        return (int)$this->phase;
    }

    /**
     * @param $duration
     * @return $this
     */
    public function setDuration($duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return (string)$this->duration;
    }

    /**
     * @param $source
     * @return $this
     */
    public function setSource($source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return (string)$this->source;
    }

    /**
     * @param $more
     * @return $this
     */
    public function setMore($more): self
    {
        $this->more = $more;

        return $this;
    }

    /**
     * @return string
     */
    public function getMore(): string
    {
        return (string)$this->more;
    }

    /**
     * @param $suitable
     * @return $this
     */
    public function setSuitable($suitable): self
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
        return (string)$this->suitable;
    }

    /**
     * Set stage
     *
     * @param string $stage
     *
     * @return Activity
     */
    public function setStage($stage): Activity
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return string
     */
    public function getStage(): string
    {
        return (string)$this->stage;
    }

    /**
     * Set forumUrl
     *
     * @param string $forumUrl
     *
     * @return Activity
     */
    public function setForumUrl($forumUrl): Activity
    {
        $this->forumUrl = $forumUrl;

        return $this;
    }

    /**
     * Get forumUrl
     *
     * @return string
     */
    public function getForumUrl(): string
    {
        return (string)$this->forumUrl;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->retromatId;
    }

    /**
     * Special method to add validation constraints on a property that is defined in a trait:
     * https://symfony.com/doc/current/reference/constraints/Valid.html
     * This could also be done via YML or XML, but all other constraints are defined via annotations
     * and I prefer to keep all constrains together in the class definition itself.
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('translations', new Assert\Valid());
        $metadata->addPropertyConstraint('newTranslations', new Assert\Valid());
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->proxyCurrentLocaleTranslation('get'.$property);
    }

    /**
     * @param $property
     * @param $argument
     * @return mixed
     */
    public function __set($property, $argument)
    {
        return $this->proxyCurrentLocaleTranslation('set'.$property, [$argument]);
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, array $arguments = [])
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}
