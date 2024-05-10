<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parking
 *
 * @ORM\Table(name="parking")
 * @ORM\Entity
 */
class Parking
{
    /**
     * @var int
     *
     * @ORM\Column(name="idParking", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparking;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacite", type="integer", nullable=true)
     */
    private $capacite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nombreActuelles", type="integer", nullable=true)
     */
    private $nombreactuelles;


}
