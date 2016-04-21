<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Record
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipantRepository")
 */
class Participant {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Resident", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $resident;
    /**
     * @ORM\Column(type="string", name="first_name", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="last_name", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="boolean", name="is_kid", length=50)
     */
    private $isKid;

    /**
     * @ORM\Column(type="string", name="special_assist", length = 255)
     */
    private $specialAssist;

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getIsKid() {
        return $this->isKid;
    }

    function getSpecialAssist() {
        return $this->specialAssist;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setIsKid($isKid) {
        $this->isKid = $isKid;
    }

    function setSpecialAssist($specialAssist) {
        $this->specialAssist = $specialAssist;
    }

    function getFirst_name() {
        return $this->first_name;
    }

    function getLast_name() {
        return $this->last_name;
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

    function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    function setLast_name($last_name) {
        $this->last_name = $last_name;
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
    function getResident() {
        return $this->resident;
    }

    function setResident($resident) {
        $this->resident = $resident;
    }

}
