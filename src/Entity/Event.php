<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="fk_user_id", columns={"id"}), @ORM\Index(name="fk_Espace_Event", columns={"idEspace"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrPersonne", type="integer", nullable=false)
     */
    private $nbrpersonne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="listeInvites", type="text", length=65535, nullable=true)
     */
    private $listeinvites;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idEspace", type="integer", nullable=true)
     */
    private $idespace;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;


}
