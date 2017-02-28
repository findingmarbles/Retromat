<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity()
 */
class Plan
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="retromatId", type="string", length=255)
     */
    private $retromatId;

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="language", type="string", length=2, options={"fixed" = true})
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="titleId", type="string", length=255)
     */
    private $titleId;

    /**
     * Set retromatId
     *
     * @param string $retromatId
     *
     * @return Plan
     */
    public function setRetromatId($retromatId)
    {
        $this->retromatId = $retromatId;

        return $this;
    }

    /**
     * Get retromatId
     *
     * @return string
     */
    public function getRetromatId()
    {
        return $this->retromatId;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return Plan
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set titleId
     *
     * @param string $titleId
     *
     * @return Plan
     */
    public function setTitleId($titleId)
    {
        $this->titleId = $titleId;

        return $this;
    }

    /**
     * Get titleId
     *
     * @return string
     */
    public function getTitleId()
    {
        return $this->titleId;
    }
}

