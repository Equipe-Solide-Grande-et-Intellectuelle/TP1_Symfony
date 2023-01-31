<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'inscription', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?lyceens $fk_lyceen = null;

    #[ORM\OneToOne(inversedBy: 'inscription', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?atelier $fk_atelier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkLyceen(): ?lyceens
    {
        return $this->fk_lyceen;
    }

    public function setFkLyceen(lyceens $fk_lyceen): self
    {
        $this->fk_lyceen = $fk_lyceen;

        return $this;
    }

    public function getFkAtelier(): ?atelier
    {
        return $this->fk_atelier;
    }

    public function setFkAtelier(atelier $fk_atelier): self
    {
        $this->fk_atelier = $fk_atelier;

        return $this;
    }
}
