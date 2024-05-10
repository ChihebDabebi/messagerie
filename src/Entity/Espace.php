<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Espace
 *
 * @ORM\Table(name="espace")
 * @ORM\Entity
 */
class Espace
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEspace", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idespace;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacite", type="integer", nullable=true)
     */
    private $capacite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;


}
