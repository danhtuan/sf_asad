<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Record
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppointmentRepository")
 */
class ClientAppointment {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ClientRecord")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clientRecord;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_appointment", type="boolean")
     */
    private $isAppointment;

    /**
     * @ORM\ManyToOne(targetEntity="CatClinic")
     * @ORM\JoinColumn(nullable=true)
     */
    private $clinic;

    /**
     *
     * @var date
     * @ORM\Column(name="appointment_date", type="date",nullable=true)
     */
    private $appointmentDate;
        
    /**
     *
     * @var time
     * @ORM\Column(name="appointment_time", type="time",nullable=true)
     */
    private $appointmentTime;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_wic", type="boolean")
     */
    private $isWIC;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_children_first", type="boolean")
     */
    private $isChildrenFirst;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_healthy_startt", type="boolean")
     */
    private $isHealthyStart;
    
 
    /**
     * @var string
     *
     * @ORM\Column(name="final_comment", type="text",nullable=true)
     */
    private $finalComment;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set isAppointment
     *
     * @param boolean $isAppointment
     * @return ClientAppointment
     */
    public function setIsAppointment($isAppointment)
    {
        $this->isAppointment = $isAppointment;

        return $this;
    }

    /**
     * Get isAppointment
     *
     * @return boolean 
     */
    public function getIsAppointment()
    {
        return $this->isAppointment;
    }

    /**
     * Set appointmentDate
     *
     * @param \DateTime $appointmentDate
     * @return ClientAppointment
     */
    public function setAppointmentDate($appointmentDate)
    {
        $this->appointmentDate = $appointmentDate;

        return $this;
    }

    /**
     * Get appointmentDate
     *
     * @return \DateTime 
     */
    public function getAppointmentDate()
    {
        return $this->appointmentDate;
    }

    /**
     * Set appointmentTime
     *
     * @param \DateTime $appointmentTime
     * @return ClientAppointment
     */
    public function setAppointmentTime($appointmentTime)
    {
        $this->appointmentTime = $appointmentTime;

        return $this;
    }

    /**
     * Get appointmentTime
     *
     * @return \DateTime 
     */
    public function getAppointmentTime()
    {
        return $this->appointmentTime;
    }

    /**
     * Set isWIC
     *
     * @param boolean $isWIC
     * @return ClientAppointment
     */
    public function setIsWIC($isWIC)
    {
        $this->isWIC = $isWIC;

        return $this;
    }

    /**
     * Get isWIC
     *
     * @return boolean 
     */
    public function getIsWIC()
    {
        return $this->isWIC;
    }

    /**
     * Set isChildrenFirst
     *
     * @param boolean $isChildrenFirst
     * @return ClientAppointment
     */
    public function setIsChildrenFirst($isChildrenFirst)
    {
        $this->isChildrenFirst = $isChildrenFirst;

        return $this;
    }

    /**
     * Get isChildrenFirst
     *
     * @return boolean 
     */
    public function getIsChildrenFirst()
    {
        return $this->isChildrenFirst;
    }

    /**
     * Set isHealthyStart
     *
     * @param boolean $isHealthyStart
     * @return ClientAppointment
     */
    public function setIsHealthyStart($isHealthyStart)
    {
        $this->isHealthyStart = $isHealthyStart;

        return $this;
    }

    /**
     * Get isHealthyStart
     *
     * @return boolean 
     */
    public function getIsHealthyStart()
    {
        return $this->isHealthyStart;
    }

    /**
     * Set finalComment
     *
     * @param string $finalComment
     * @return ClientAppointment
     */
    public function setFinalComment($finalComment)
    {
        $this->finalComment = $finalComment;

        return $this;
    }

    /**
     * Get finalComment
     *
     * @return string 
     */
    public function getFinalComment()
    {
        return $this->finalComment;
    }

    /**
     * Set clinic
     *
     * @param \AppBundle\Entity\CatClinic $clinic
     * @return ClientAppointment
     */
    public function setClinic(\AppBundle\Entity\CatClinic $clinic = null)
    {
        $this->clinic = $clinic;

        return $this;
    }

    /**
     * Get clinic
     *
     * @return \AppBundle\Entity\CatClinic 
     */
    public function getClinic()
    {
        return $this->clinic;
    }

    /**
     * Set clientRecord
     *
     * @param \AppBundle\Entity\ClientRecord $clientRecord
     * @return ClientAppointment
     */
    public function setClientRecord(\AppBundle\Entity\ClientRecord $clientRecord)
    {
        $this->clientRecord = $clientRecord;

        return $this;
    }

    /**
     * Get clientRecord
     *
     * @return \AppBundle\Entity\ClientRecord 
     */
    public function getClientRecord()
    {
        return $this->clientRecord;
    }
}
