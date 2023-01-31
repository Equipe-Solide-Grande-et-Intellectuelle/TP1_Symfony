<?php

namespace App\Entity;

use App\Repository\LyceensRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LyceensRepository::class)]
class Lyceens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $lycee = null;

    #[ORM\Column(length: 8)]
    private ?string $section = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $tel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\OneToOne(mappedBy: 'fk_lyceen', cascade: ['persist', 'remove'])]
    private ?Inscription $inscription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLycee(): ?string
    {
        return $this->lycee;
    }

    public function setLycee(string $lycee): self
    {
        $this->lycee = $lycee;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(Inscription $inscription): self
    {
        // set the owning side of the relation if necessary
        if ($inscription->getFkLyceen() !== $this) {
            $inscription->setFkLyceen($this);
        }

        $this->inscription = $inscription;

        return $this;
    }
}
