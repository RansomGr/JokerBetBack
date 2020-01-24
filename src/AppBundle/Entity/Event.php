<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     *
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eventTime", type="datetime")
     */
    private $eventTime;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="home", type="string", length=255)
     */
    private $home;

    /**
     * @var string
     *
     * @ORM\Column(name="away", type="string", length=255)
     */
    private $away;

    /**
     * @var int
     *
     * @ORM\Column(name="hour_event_id", type="integer")
     */
    private $hourEventId;

    /**
     * @var mixed
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\CategoryOdds",cascade={"merge"} ,fetch="EAGER")
     *
     */
    private $categoryOdds;
    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\League",cascade={"merge"} )
     *
     */
    private $league;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventTime
     *
     * @param \DateTime $eventTime
     *
     * @return Event
     */
    public function setEventTime($eventTime)
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    /**
     * Get eventTime
     *
     * @return \DateTime
     */
    public function getEventTime()
    {
        return $this->eventTime;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Event
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set home
     *
     * @param string $home
     *
     * @return Event
     */
    public function setHome($home)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return string
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set away
     *
     * @param string $away
     *
     * @return Event
     */
    public function setAway($away)
    {
        $this->away = $away;
        return $this;
    }

    /**
     * Get away
     *
     * @return string
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * Set hourEventId
     *
     * @param integer $hourEventId
     *
     * @return Event
     */
    public function setHourEventId($hourEventId)
    {
        $this->hourEventId = $hourEventId;

        return $this;
    }

    /**
     * Get hourEventId
     *
     * @return int
     */
    public function getHourEventId()
    {
        return $this->hourEventId;
    }

    /**
     * @return mixed
     */
    public function getCategoryOdds()
    {
        return $this->categoryOdds;
    }

    /**
     * @param mixed $categoryOdds
     */
    public function setCategoryOdds($categoryOdds)
    {
        $this->categoryOdds = $categoryOdds;
    }

    /**
     * @return mixed
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param mixed $league
     */
    public function setLeague($league)
    {
        $this->league = $league;
    }

}

