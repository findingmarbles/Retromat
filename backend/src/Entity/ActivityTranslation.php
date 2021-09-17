<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="activity_translation")
 * @ORM\Entity()
 */
class ActivityTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
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
     * @ORM\Column(name="`desc`", type="text")
     */
    private $desc;

    /**
     * @param $name
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $summary
     * @return $this
     */
    public function setSummary($summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param $desc
     * @return $this
     */
    public function setDesc($desc): self
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }
}
