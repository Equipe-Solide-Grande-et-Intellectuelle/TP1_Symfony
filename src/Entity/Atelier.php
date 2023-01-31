<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ressources = null;

    #[ORM\ManyToMany(targetEntity: metiers::class, inversedBy: 'ateliers')]
    private Collection $fk_metiers;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?salle $salle = null;

    #[ORM\ManyToMany(targetEntity: intervenants::class, inversedBy: 'ateliers')]
    private Collection $fk_intervenants;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?secteur $fk_secteur = null;

    #[ORM\OneToOne(mappedBy: 'fk_atelier', cascade: ['persist', 'remove'])]
    private ?Inscription $inscription = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->fk_metiers = new ArrayCollection();
        $this->fk_intervenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRessources(): ?string
    {
        return $this->ressources;
    }

    public function setRessources(string $ressources): self
    {
        $this->ressources = $ressources;

        return $this;
    }

    /**
     * @return Collection<int, metiers>
     */
    public function getFkMetiers(): Collection
    {
        return $this->fk_metiers;
    }

    public function addFkMetier(metiers $fkMetier): self
    {
        if (!$this->fk_metiers->contains($fkMetier)) {
            $this->fk_metiers->add($fkMetier);
        }

        return $this;
    }

    public function removeFkMetier(metiers $fkMetier): self
    {
        $this->fk_metiers->removeElement($fkMetier);

        return $this;
    }

    public function getSalle(): ?salle
    {
        return $this->salle;
    }

    public function setSalle(?salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return Collection<int, intervenants>
     */
    public function getFkIntervenants(): Collection
    {
        return $this->fk_intervenants;
    }

    public function addFkIntervenant(intervenants $fkIntervenant): self
    {
        if (!$this->fk_intervenants->contains($fkIntervenant)) {
            $this->fk_intervenants->add($fkIntervenant);
        }

        return $this;
    }

    public function removeFkIntervenant(intervenants $fkIntervenant): self
    {
        $this->fk_intervenants->removeElement($fkIntervenant);

        return $this;
    }

    public function getFkSecteur(): ?secteur
    {
        return $this->fk_secteur;
    }

    public function setFkSecteur(?secteur $fk_secteur): self
    {
        $this->fk_secteur = $fk_secteur;

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(Inscription $inscription): self
    {
        // set the owning side of the relation if necessary
        if ($inscription->getFkAtelier() !== $this) {
            $inscription->setFkAtelier($this);
        }

        $this->inscription = $inscription;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
