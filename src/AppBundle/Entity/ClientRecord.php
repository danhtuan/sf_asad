<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Record
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRecordRepository")
 */
class ClientRecord {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operator;
    
    private $operatorName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="smallint")
     */
    private $priority;

    /**
     *
     * @var datetime
     * @ORM\Column(name="date_of_call", type="datetime")
     */
    private $dateOfCall;

    /**
     *
     * @var string
     * @ORM\Column(name="client_id", type="string", length=15)
     */
    private $clientID;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="middle_name", type="string", length=100,nullable=true)
     */
    private $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastName;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="smallint")
     */
    private $age;

    /**
     * @var date 
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @ORM\ManyToOne(targetEntity="CatRace")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     *
     * @var string 
     * @ORM\Column(name="is_hispanic", type="boolean")
     */
    private $isHispanic;

    /**
     *
     * @var string
     * @ORM\Column(name="street_address", type="string", length=255)
     */
    private $streetAddress;

    /**
     *
     * @var string
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     *
     * @var string
     * @ORM\Column(name="zipcode", type="string", length=5)
     */
    private $zipcode;

    /**
     *
     * @var boolean
     * @ORM\Column(name="can_message", type="boolean")
     */
    private $canMessage;

    /**
     *
     * @var string
     * @ORM\Column(name="phone_number", type="string", length=10)
     */
    private $phoneNumber;

    /**
     *
     * @var string
     * @ORM\Column(name="other_number", type="string", length=10,nullable=true)
     */
    private $otherNumber;

    /**
     * @ORM\ManyToOne(targetEntity="CatMaritalStatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maritalStatus;

    /**
     * @ORM\ManyToOne(targetEntity="CatEducation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $education;

    /**
     *
     * @var string
     * @ORM\Column(name="current_school", type="string", length=255)
     */
    private $currentSchool;

    /**
     *
     * @var boolean
     * @ORM\Column(name="is_employed", type="boolean")
     */
    private $isEmployed;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_household", type="smallint")
     */
    private $numHousehold;

    /**
     * @ORM\ManyToOne(targetEntity="CatIncome")
     * @ORM\JoinColumn(nullable=false)
     */
    private $income;
    
    /**
     * @ORM\OneToMany(
     *      targetEntity="ClientHealthRecord",
     *      mappedBy="clientRecord",
     *      orphanRemoval=true
     * )
     */
    private $healthRecord;
    
    /**
     * @ORM\OneToMany(
     *      targetEntity="ClientAppointment",
     *      mappedBy="clientRecord",
     *      orphanRemoval=true
     * )
     */
    private $clientAppointment;
    
    public function __construct()
    {
        $this->dateOfCall = new \DateTime();
        $this->healthRecord = new ArrayCollection();
        $this->clientAppointment = new ArrayCollection();
    }
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Record
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Record
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Record
     */
    public function setAge($age) {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge() {
        return $this->age;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     * @return Record
     */
    public function setDob($dob) {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime 
     */
    public function getDob() {
        return $this->dob;
    }

    /**
     * Set isHispanic
     *
     * @param boolean $isHispanic
     * @return Record
     */
    public function setIsHispanic($isHispanic) {
        $this->isHispanic = $isHispanic;

        return $this;
    }

    /**
     * Get isHispanic
     *
     * @return boolean 
     */
    public function getIsHispanic() {
        return $this->isHispanic;
    }

    /**
     * Set streetAddress
     *
     * @param string $streetAddress
     * @return Record
     */
    public function setStreetAddress($streetAddress) {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    /**
     * Get streetAddress
     *
     * @return string 
     */
    public function getStreetAddress() {
        return $this->streetAddress;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Record
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Record
     */
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode() {
        return $this->zipcode;
    }

    /**
     * Set canMessage
     *
     * @param boolean $canMessage
     * @return Record
     */
    public function setCanMessage($canMessage) {
        $this->canMessage = $canMessage;

        return $this;
    }

    /**
     * Get canMessage
     *
     * @return boolean 
     */
    public function getCanMessage() {
        return $this->canMessage;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Record
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * Set race
     *
     * @param \AppBundle\Entity\Race $race
     * @return Record
     */
    public function setRace(\AppBundle\Entity\CatRace $race) {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return \AppBundle\Entity\CatRace 
     */
    public function getRace() {
        return $this->race;
    }

    /**
     * Set dateOfCall
     *
     * @param \DateTime $dateOfCall
     * @return Record
     */
    public function setDateOfCall($dateOfCall) {
        $this->dateOfCall = $dateOfCall;

        return $this;
    }

    /**
     * Get dateOfCall
     *
     * @return \DateTime 
     */
    public function getDateOfCall() {
        return $this->dateOfCall;
    }

    /**
     * Set clientID
     *
     * @param string $clientID
     * @return Record
     */
    public function setClientID($clientID) {
        $this->clientID = $clientID;

        return $this;
    }

    /**
     * Get clientID
     *
     * @return string 
     */
    public function getClientID() {
        return $this->clientID;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     * @return Record
     */
    public function setMiddleName($middleName) {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string 
     */
    public function getMiddleName() {
        return $this->middleName;
    }

    /**
     * Set currentSchool
     *
     * @param string $currentSchool
     * @return Record
     */
    public function setCurrentSchool($currentSchool) {
        $this->currentSchool = $currentSchool;

        return $this;
    }

    /**
     * Get currentSchool
     *
     * @return string 
     */
    public function getCurrentSchool() {
        return $this->currentSchool;
    }

    /**
     * Set isEmployed
     *
     * @param boolean $isEmployed
     * @return Record
     */
    public function setIsEmployed($isEmployed) {
        $this->isEmployed = $isEmployed;

        return $this;
    }

    /**
     * Get isEmployed
     *
     * @return boolean 
     */
    public function getIsEmployed() {
        return $this->isEmployed;
    }

    /**
     * Set numHousehold
     *
     * @param integer $numHousehold
     * @return Record
     */
    public function setNumHousehold($numHousehold) {
        $this->numHousehold = $numHousehold;

        return $this;
    }

    /**
     * Get numHousehold
     *
     * @return integer 
     */
    public function getNumHousehold() {
        return $this->numHousehold;
    }

    /**
     * Set operator
     *
     * @param \AppBundle\Entity\User $operator
     * @return Record
     */
    public function setOperator(\AppBundle\Entity\User $operator) {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return \AppBundle\Entity\User 
     */
    public function getOperator() {
        return $this->operator;
    }

    /**
     * Set maritalStatus
     *
     * @param \AppBundle\Entity\MaritalStatus $maritalStatus
     * @return Record
     */
    public function setMaritalStatus(\AppBundle\Entity\CatMaritalStatus $maritalStatus) {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return \AppBundle\Entity\CatMaritalStatus 
     */
    public function getMaritalStatus() {
        return $this->maritalStatus;
    }

    /**
     * Set education
     *
     * @param \AppBundle\Entity\Education $education
     * @return Record
     */
    public function setEducation(\AppBundle\Entity\CatEducation $education) {
        $this->education = $education;

        return $this;
    }

    /**
     * Get education
     *
     * @return \AppBundle\Entity\CatEducation 
     */
    public function getEducation() {
        return $this->education;
    }

    /**
     * Set income
     *
     * @param \AppBundle\Entity\Income $income
     * @return Record
     */
    public function setIncome(\AppBundle\Entity\CatIncome $income) {
        $this->income = $income;

        return $this;
    }

    /**
     * Get income
     *
     * @return \AppBundle\Entity\CatIncome 
     */
    public function getIncome() {
        return $this->income;
    }

    public function getOperatorName() {
        return $this->operatorName;
    }

    public function setOperatorName($operatorName) {
        $this->operatorName = $operatorName;
    }

    /**
     * Set otherNumber
     *
     * @param string $otherNumber
     * @return ClientRecord
     */
    public function setOtherNumber($otherNumber) {
        $this->otherNumber = $otherNumber;

        return $this;
    }

    /**
     * Get otherNumber
     *
     * @return string 
     */
    public function getOtherNumber() {
        return $this->otherNumber;
    }

    /**
     * Is the given User the author of this Post?
     *
     * @param User $user
     *
     * @return bool
     */
    public function isAuthor(User $user) {
        return $user->getUsername() == $this->getOperator()->getUsername();
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return ClientRecord
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus() {
        return $this->status;
    }


    /**
     * Set priority
     *
     * @param integer $priority
     * @return ClientRecord
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Add healthRecord
     *
     * @param \AppBundle\Entity\ClientHealthRecord $healthRecord
     * @return ClientRecord
     */
    public function addHealthRecord(\AppBundle\Entity\ClientHealthRecord $healthRecord)
    {
        $this->healthRecord[] = $healthRecord;

        return $this;
    }

    /**
     * Remove healthRecord
     *
     * @param \AppBundle\Entity\ClientHealthRecord $healthRecord
     */
    public function removeHealthRecord(\AppBundle\Entity\ClientHealthRecord $healthRecord)
    {
        $this->healthRecord->removeElement($healthRecord);
    }

    /**
     * Get healthRecord
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHealthRecord()
    {
        return $this->healthRecord;
    }

    /**
     * Add clientAppointment
     *
     * @param \AppBundle\Entity\ClientAppointment $clientAppointment
     * @return ClientRecord
     */
    public function addClientAppointment(\AppBundle\Entity\ClientAppointment $clientAppointment)
    {
        $this->clientAppointment[] = $clientAppointment;

        return $this;
    }

    /**
     * Remove clientAppointment
     *
     * @param \AppBundle\Entity\ClientAppointment $clientAppointment
     */
    public function removeClientAppointment(\AppBundle\Entity\ClientAppointment $clientAppointment)
    {
        $this->clientAppointment->removeElement($clientAppointment);
    }

    /**
     * Get clientAppointment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientAppointment()
    {
        return $this->clientAppointment;
    }
}
