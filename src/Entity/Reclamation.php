<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="rec_user", columns={"idU"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descriRec", type="text", length=65535, nullable=true)
     */
    private $descrirec;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateRec", type="date", nullable=true)
     */
    private $daterec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CategorieRec", type="string", length=255, nullable=true)
     */
    private $categorierec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="StatutRec", type="string", length=50, nullable=true)
     */
    private $statutrec;

    /**
     * @var string
     *
     * @ORM\Column(name="imageData", type="blob", length=0, nullable=false)
     */
    private $imagedata;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idU", referencedColumnName="id")
     * })
     */
    private $idu;


}
