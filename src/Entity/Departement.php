<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
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
    private $codeDepartement;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomDepartement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="detenir")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ville", mappedBy="departement")
     */
    private $posseder;

    public function __construct()
    {
        $this->posseder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(string $codeDepartement): self
    {
        $this->codeDepartement = $codeDepartement;

        return $this;
    }

    public function getNomDepartement(): ?string
    {
        return $this->nomDepartement;
    }

    public function setNomDepartement(string $nomDepartement): self
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getPosseder(): Collection
    {
        return $this->posseder;
    }

    public function addPosseder(Ville $posseder): self
    {
        if (!$this->posseder->contains($posseder)) {
            $this->posseder[] = $posseder;
            $posseder->setDepartement($this);
        }

        return $this;
    }

    public function removePosseder(Ville $posseder): self
    {
        if ($this->posseder->contains($posseder)) {
            $this->posseder->removeElement($posseder);
            // set the owning side to null (unless already changed)
            if ($posseder->getDepartement() === $this) {
                $posseder->setDepartement(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->nomDepartement;
    }
}
