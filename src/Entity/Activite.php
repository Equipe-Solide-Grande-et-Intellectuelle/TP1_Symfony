<?php

namespace App\Entity;

use App\Repository\ActivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitesRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Metier::class, mappedBy: 'activites')]
    private Collection $metiers;

    public function __construct()
    {
        $this->metiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Metier>
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metier $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers->add($metier);
            $metier->addActivite($this);
        }

        return $this;
    }

    public function removeMetier(Metier $metier): self
    {
        if ($this->metiers->removeElement($metier)) {
            $metier->removeActivite($this);
        }

        return $this;
    }
}
