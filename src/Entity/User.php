<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 180)]
    private $nom;

   
    #[ORM\Column(length: 180)]
    private $prenom;

   
    #[ORM\Column(length: 180)]
    private $number;

   
    #[ORM\Column(length: 180)]
    private $mail;

    #[ORM\Column(length: 180)]
    private $password;

    #[ORM\Column(length: 180)]
    private $role;
   // Getter et setter pour number
   public function getId(): ?int
   {
       return $this->id;
   }
   public function setId(int $id): static
   {
       $this->id = $id;

       return $this;
   }
   public function getNom(): ?string
   {
       return $this->nom;
   }

   public function setNom(string $nom): static
   {
       $this->nom = $nom;

       return $this;
   }

   public function getNumber(): ?string
   {
       return $this->number;
   }

   public function setNumber(string $number): self
   {
       $this->number = $number;

       return $this;
   }

   // Getter et setter pour mail
   public function getMail(): ?string
   {
       return $this->mail;
   }

   public function setMail(string $mail): self
   {
       $this->mail = $mail;

       return $this;
   }

   // Getter et setter pour password
   public function getPassword(): ?string
   {
       return $this->password;
   }

   public function setPassword(string $password): self
   {
       $this->password = $password;

       return $this;
   }

   // Getter et setter pour role
   public function getRole(): ?string
   {
       return $this->role;
   }

   public function setRole(string $role): self
   {
       $this->role = $role;

       return $this;
   }

   // Méthode magique __toString
   public function __toString(): string
   {
       return $this->nom . ' ' . $this->prenom;
   }

}

