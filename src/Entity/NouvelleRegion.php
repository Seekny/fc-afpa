<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NouvelleRegionRepository")
 */
class NouvelleRegion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $codeNouvelleRegion;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomNouvelleRegion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Region", mappedBy="nouvelleRegion")
     */
    private $concerner;

    public function __construct()
    {
        $this->concerner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeNouvelleRegion(): ?string
    {
        return $this->codeNouvelleRegion;
    }

    public function setCodeNouvelleRegion(string $codeNouvelleRegion): self
    {
        $this->codeNouvelleRegion = $codeNouvelleRegion;

        return $this;
    }

    public function getNomNouvelleRegion(): ?string
    {
        return $this->nomNouvelleRegion;
    }

    public function setNomNouvelleRegion(string $nomNouvelleRegion): self
    {
        $this->nomNouvelleRegion = $nomNouvelleRegion;

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getConcerner(): Collection
    {
        return $this->concerner;
    }

    public function addConcerner(Region $concerner): self
    {
        if (!$this->concerner->contains($concerner)) {
            $this->concerner[] = $concerner;
            $concerner->setNouvelleRegion($this);
        }

        return $this;
    }

    public function removeConcerner(Region $concerner): self
    {
        if ($this->concerner->contains($concerner)) {
            $this->concerner->removeElement($concerner);
            // set the owning side to null (unless already changed)
            if ($concerner->getNouvelleRegion() === $this) {
                $concerner->setNouvelleRegion(null);
            }
        }

        return $this;
    }
}
