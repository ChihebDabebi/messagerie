<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture", indexes={@ORM\Index(name="fk_id", columns={"id"}), @ORM\Index(name="fk_idParking", columns={"idParking"})})
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="idVoiture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvoiture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="marque", type="string", length=100, nullable=true)
     */
    private $marque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="model", type="string", length=100, nullable=true)
     */
    private $model;

    /**
     * @var string|null
     *
     * @ORM\Column(name="couleur", type="string", length=50, nullable=true)
     */
    private $couleur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="matricule", type="string", length=50, nullable=true)
     */
    private $matricule;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idParking", type="integer", nullable=true)
     */
    private $idparking;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;


}
