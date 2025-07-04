<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="activity_translation")
 */
class ActivityTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Type("string")
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="`name`", type="string", length=255)
     */
    private $name = '';

    /**
     * @var string
     *
     * @Assert\Type("string")
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary = '';

    /**
     * @var string
     *
     * @Assert\Type("string")
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="`desc`", type="text")
     */
    private $desc = '';

    /**
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setSummary($summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return $this
     */
    public function setDesc($desc): self
    {
        $this->desc = $desc;

        return $this;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }
}
