<?php

namespace TM\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="TM\ChatBundle\Repository\MessageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Message
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
     * @ORM\ManyToOne(targetEntity="TM\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_sender", referencedColumnName="id")
     **/
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="TM\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_receiver", referencedColumnName="id")
     **/
    private $receiver;

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
     * @ORM\Column(name="date", type="datetime")
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @ORM\PrePersist
     */
    public function preDate()
    {
        $this->setDate(new \Datetime());
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
     * Set content
     *
     * @param string $content
     *
     * @return Message
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set sender
     *
     * @param \TM\UserBundle\Entity\User $sender
     *
     * @return Message
     */
    public function setSender(\TM\UserBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \TM\UserBundle\Entity\User
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param \TM\UserBundle\Entity\User $receiver
     *
     * @return Message
     */
    public function setReceiver(\TM\UserBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \TM\UserBundle\Entity\User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
