<?php

namespace TM\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Comment
 * @package TM\PlatformBundle\Entity
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="TM\PlatformBundle\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
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
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     * @Assert\DateTime()
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $updateDate;

    /**
     * @ORM\ManyToOne(targetEntity="TM\PlatformBundle\Entity\Travel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $travel;

    /**
     * @ORM\ManyToOne(targetEntity="TM\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     **/
    private $user;

    /**
     * @ORM\PrePersist
     */
    public function preCreationDate()
    {
        $this->setCreationDate(new \Datetime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateDate()
    {
        $this->setUpdateDate(new \Datetime());
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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Comment
     */
    public function setCreationDate($creationDate)
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
     * @return Comment
     */
    public function setUpdateDate($updateDate)
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
     * Set travel
     *
     * @param \TM\PlatformBundle\Entity\Travel $travel
     *
     * @return Comment
     */
    public function setTravel(\TM\PlatformBundle\Entity\Travel $travel)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return \TM\PlatformBundle\Entity\Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set user
     *
     * @param \TM\UserBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\TM\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \TM\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
