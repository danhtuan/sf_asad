<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * Defines the properties of the User entity to represent the application users.
 * See http://symfony.com/doc/current/book/doctrine.html#creating-an-entity-class
 *
 * Tip: if you have an existing database, you can generate these entity class automatically.
 * See http://symfony.com/doc/current/cookbook/doctrine/reverse_engineering.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */

/**
 * Record
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResidentRepository")
 */
class Resident {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="event_id")
     */
    private $eventId;
    
    /**
     * @ORM\Column(type="string")
     */
    private $CWID;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="first_name", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="last_name", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length = 100)
     */
    private $building;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $apt;

    /**
     * @ORM\Column(type="string", length = 12)
     */
    private $phone;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Participant",
     *      mappedBy="resident",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $participants;
    
    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getBuilding() {
        return $this->building;
    }

    function getApt() {
        return $this->apt;
    }

    function getPhone() {
        return $this->phone;
    }

    function setFirstName($first_name) {
        $this->firstName = $first_name;
    }

    function setLastName($last_name) {
        $this->lastName = $last_name;
    }

    function setBuilding($building) {
        $this->building = $building;
    }

    function setApt($apt) {
        $this->apt = $apt;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    function getCWID() {
        return $this->CWID;
    }

    function setCWID($CWID) {
        $this->CWID = $CWID;
    }
    function setParticipants(ArrayCollection $participants) {
        $this->participants = $participants;
    }

    function getParticipants() {
        return $this->participants;
    }
    
    function addParticipant(Participant $participant){
        $this->participants->add($participant);
    }
    function removeParticipant(Participant $participant){
        $this->participants->removeElement($participant);
    }
    function getEventId() {
        return $this->eventId;
    }

    function setEventId($eventId) {
        $this->eventId = $eventId;
    }

}