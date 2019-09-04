<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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
    private $codeRegion;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomRegion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NouvelleRegion", inversedBy="concerner")
     */
    private $nouvelleRegion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Departement", mappedBy="region")
     */
    private $detenir;

    public function __construct()
    {
        $this->detenir = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeRegion(): ?string
    {
        return $this->codeRegion;
    }

    public function setCodeRegion(string $codeRegion): self
    {
        $this->codeRegion = $codeRegion;

        return $this;
    }

    public function getNomRegion(): ?string
    {
        return $this->nomRegion;
    }

    public function setNomRegion(string $nomRegion): self
    {
        $this->nomRegion = $nomRegion;

        return $this;
    }

    public function getNouvelleRegion(): ?NouvelleRegion
    {
        return $this->nouvelleRegion;
    }

    public function setNouvelleRegion(?NouvelleRegion $nouvelleRegion): self
    {
        $this->nouvelleRegion = $nouvelleRegion;

        return $this;
    }

    /**
     * @return Collection|Departement[]
     */
    public function getDetenir(): Collection
    {
        return $this->detenir;
    }

    public function addDetenir(Departement $detenir): self
    {
        if (!$this->detenir->contains($detenir)) {
            $this->detenir[] = $detenir;
            $detenir->setRegion($this);
        }

        return $this;
    }

    public function removeDetenir(Departement $detenir): self
    {
        if ($this->detenir->contains($detenir)) {
            $this->detenir->removeElement($detenir);
            // set the owning side to null (unless already changed)
            if ($detenir->getRegion() === $this) {
                $detenir->setRegion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->nomRegion;
    }
}
