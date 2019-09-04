<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomVille;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $codeInsee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="posseder")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Utilisateur", mappedBy="ville")
     */
    private $habiter;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->habiter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): self
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCodeInsee(): ?string
    {
        return $this->codeInsee;
    }

    public function setCodeInsee(string $codeInsee): self
    {
        $this->codeInsee = $codeInsee;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setHabiter($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->removeElement($utilisateur);
            // set the owning side to null (unless already changed)
            if ($utilisateur->getHabiter() === $this) {
                $utilisateur->setHabiter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getHabiter(): Collection
    {
        return $this->habiter;
    }

    public function addHabiter(Utilisateur $habiter): self
    {
        if (!$this->habiter->contains($habiter)) {
            $this->habiter[] = $habiter;
            $habiter->setVille($this);
        }

        return $this;
    }

    public function removeHabiter(Utilisateur $habiter): self
    {
        if ($this->habiter->contains($habiter)) {
            $this->habiter->removeElement($habiter);
            // set the owning side to null (unless already changed)
            if ($habiter->getVille() === $this) {
                $habiter->setVille(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->nomVille;
    }
}
