<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @var int
     *
     * Internal id used by the Doctine ORM.
     *
     * @ORM\Column(name="doctrine_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $doctrineId;

    /**
     * @var int
     *
     * Retromat activity id which the original retromat uses both internally and publicly.
     *
     * @ORM\Column(name="retromat_id", type="smallint", unique=true)
     */
    private $retromatId;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=2)
     */
    private $language;

    /**
     * @var int
     *
     * Using `backticks` to avoid mysql reserved keyword https://dev.mysql.com/doc/refman/5.5/en/keywords.html
     *
     * @ORM\Column(name="`phase`", type="smallint")
     */
    private $phase;

    /**
     * @var string
     *
     * Using `backticks` to avoid mysql reserved keyword https://dev.mysql.com/doc/refman/5.5/en/keywords.html
     *
     * @ORM\Column(name="`name`", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary;

    /**
     * @var string
     *
     * Using `backticks` to avoid mysql reserved keyword https://dev.mysql.com/doc/refman/5.5/en/keywords.html
     *
     * @ORM\Column(name="`desc`", type="text")
     */
    private $desc;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="text", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="more", type="text", nullable=true)
     */
    private $more;

    /**
     * @var string
     *
     * @ORM\Column(name="suitable", type="string", length=255, nullable=true)
     */
    private $suitable;


    /**
     * Set retromatId
     *
     * @param integer $retromatId
     *
     * @return Activity
     */
    public function setRetromatId($retromatId)
    {
        $this->retromatId = $retromatId;

        return $this;
    }

    /**
     * Get retromatId
     *
     * @return int
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
     * @return Activity
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
     * Set phase
     *
     * @param integer $phase
     *
     * @return Activity
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * Get phase
     *
     * @return int
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Activity
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
     * @return Activity
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
     * @return Activity
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

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Activity
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Activity
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set more
     *
     * @param string $more
     *
     * @return Activity
     */
    public function setMore($more)
    {
        $this->more = $more;

        return $this;
    }

    /**
     * Get more
     *
     * @return string
     */
    public function getMore()
    {
        return $this->more;
    }

    /**
     * Set suitable
     *
     * @param string $suitable
     *
     * @return Activity
     */
    public function setSuitable($suitable)
    {
        $this->suitable = $suitable;

        return $this;
    }

    /**
     * Get suitable
     *
     * @return string
     */
    public function getSuitable()
    {
        return $this->suitable;
    }

    /**
     * Get doctrineId
     *
     * @return integer
     */
    public function getDoctrineId()
    {
        return $this->doctrineId;
    }

    /**
     * Get doctrineId
     *
     * CRUD generator needs this.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->getDoctrineId();
    }
}
