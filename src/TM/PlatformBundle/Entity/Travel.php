<?php

namespace TM\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Travel
 *
 * @ORM\Table(name="travel")
 * @ORM\Entity(repositoryClass="TM\PlatformBundle\Repository\TravelRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Travel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_mate", type="integer")
     * @Assert\Type(type="integer")
     * @Assert\Range(min = 1)
     */
    private $nbMate;

    /**
     * @var int
     *
     * @ORM\Column(name="cost", type="integer")
     * @Assert\Type(type="integer")
     * @Assert\Range(min = 1, max = 5)
     */
    private $cost;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date")
     * @Assert\Date()
     * @Assert\Range(min = "now")
     */
    private $startDate;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_duration", type="integer")
     * @Assert\Type(type="integer")
     * @Assert\Range(min = 1)
     */
    private $nbDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="type_duration", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Choice(choices = {"day", "week", "month", "year"})
     */
    private $typeDuration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     * @Assert\DateTime()
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="countries", type="simple_array", length=255)
     * @Assert\All({
     *     @Assert\Country()
     * })
     * @Assert\Count(min = 1)
     */
    private $countries;

    /**
     * @ORM\ManyToMany(targetEntity="TM\PlatformBundle\Entity\Category",
     *     cascade={"persist"})
     * @Assert\Count(min = 1)
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function creationDate()
    {
        $this->setCreationDate(new \Datetime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdateDate(new \Datetime());
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Travel
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Travel
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set nbMate
     *
     * @param integer $nbMate
     *
     * @return Travel
     */
    public function setNbMate($nbMate)
    {
        $this->nbMate = $nbMate;

        return $this;
    }

    /**
     * Get nbMate
     *
     * @return integer
     */
    public function getNbMate()
    {
        return $this->nbMate;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Travel
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Travel
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set nbDuration
     *
     * @param integer $nbDuration
     *
     * @return Travel
     */
    public function setNbDuration($nbDuration)
    {
        $this->nbDuration = $nbDuration;

        return $this;
    }

    /**
     * Get nbDuration
     *
     * @return integer
     */
    public function getNbDuration()
    {
        return $this->nbDuration;
    }

    /**
     * Set typeDuration
     *
     * @param string $typeDuration
     *
     * @return Travel
     */
    public function setTypeDuration($typeDuration)
    {
        $this->typeDuration = $typeDuration;

        return $this;
    }

    /**
     * Get typeDuration
     *
     * @return string
     */
    public function getTypeDuration()
    {
        return $this->typeDuration;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Travel
     */
    public function setCreationDate(\Datetime $creationDate = null)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Travel
     */
    public function setUpdateDate(\Datetime $updateDate = null)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set countries
     *
     * @param array $countries
     *
     * @return Travel
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;

        return $this;
    }

    /**
     * Get countries
     *
     * @return array
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Add category
     *
     * @param \TM\PlatformBundle\Entity\Category $category
     *
     * @return Travel
     */
    public function addCategory(\TM\PlatformBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \TM\PlatformBundle\Entity\Category $category
     */
    public function removeCategory(\TM\PlatformBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
