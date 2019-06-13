<?php
// src/Acme/MessageBundle/Entity/MessageMetadata.php

namespace MedBrief\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;
use FOS\MessageBundle\Model\MessageInterface;
use FOS\MessageBundle\Model\ParticipantInterface;

/**
 * @ORM\Entity
 */
class MessageMetadata extends BaseMessageMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="MedBrief\CoreBundle\Entity\Message",
     *   inversedBy="metadata"
     * )
     * @var MessageInterface
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="MedBrief\CoreBundle\Entity\User")
     * @var ParticipantInterface
     */
    protected $participant;
}