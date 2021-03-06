<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    
    private $name;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="smallint", name="max_slot")
     */
    private $maxOccupancy;

    /**
     * @ORM\Column(type="smallint", name="free_slot")
     */
    private $freeOccupancy;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Event
     */
    public function setTime($time) {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * Set maxOccupancy
     *
     * @param integer $maxOccupancy
     * @return Event
     */
    public function setMaxOccupancy($maxOccupancy) {
        $this->maxOccupancy = $maxOccupancy;

        return $this;
    }

    /**
     * Get maxOccupancy
     *
     * @return integer 
     */
    public function getMaxOccupancy() {
        return $this->maxOccupancy;
    }


    /**
     * Set freeOccupancy
     *
     * @param integer $freeOccupancy
     * @return Event
     */
    public function setFreeOccupancy($freeOccupancy)
    {
        $this->freeOccupancy = $freeOccupancy;

        return $this;
    }

    /**
     * Get freeOccupancy
     *
     * @return integer 
     */
    public function getFreeOccupancy()
    {
        return $this->freeOccupancy;
    }
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }


}
