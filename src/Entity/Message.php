<?php
// src/Acme/MessageBundle/Entity/Message.php

namespace Sideclick\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

/**
 * @ORM\Entity
 */
class Message extends BaseMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="Sideclick\CoreBundle\Entity\Thread",
     *   inversedBy="messages"
     * )
     * @var ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="Sideclick\CoreBundle\Entity\User")
     * @var ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="Sideclick\CoreBundle\Entity\MessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata
     */
    protected $metadata;
}