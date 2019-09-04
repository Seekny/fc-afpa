<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeClassementRepository")
 */
class GroupeClassement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $nomGroupe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Classement", mappedBy="groupeClassement")
     */
    private $impliquer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matchs", mappedBy="groupeClassement")
     */
    private $grouper;

    public function __construct()
    {
        $this->impliquer = new ArrayCollection();
        $this->grouper = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGroupe(): ?string
    {
        return $this->nomGroupe;
    }

    public function setNomGroupe(string $nomGroupe): self
    {
        $this->nomGroupe = $nomGroupe;

        return $this;
    }

    /**
     * @return Collection|Classement[]
     */
    public function getImpliquer(): Collection
    {
        return $this->impliquer;
    }

    public function addImpliquer(Classement $impliquer): self
    {
        if (!$this->impliquer->contains($impliquer)) {
            $this->impliquer[] = $impliquer;
            $impliquer->setGroupeClassement($this);
        }

        return $this;
    }

    public function removeImpliquer(Classement $impliquer): self
    {
        if ($this->impliquer->contains($impliquer)) {
            $this->impliquer->removeElement($impliquer);
            // set the owning side to null (unless already changed)
            if ($impliquer->getGroupeClassement() === $this) {
                $impliquer->setGroupeClassement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Matchs[]
     */
    public function getGrouper(): Collection
    {
        return $this->grouper;
    }

    public function addGrouper(Matchs $grouper): self
    {
        if (!$this->grouper->contains($grouper)) {
            $this->grouper[] = $grouper;
            $grouper->setGroupeClassement($this);
        }

        return $this;
    }

    public function removeGrouper(Matchs $grouper): self
    {
        if ($this->grouper->contains($grouper)) {
            $this->grouper->removeElement($grouper);
            // set the owning side to null (unless already changed)
            if ($grouper->getGroupeClassement() === $this) {
                $grouper->setGroupeClassement(null);
            }
        }

        return $this;
    }
}
