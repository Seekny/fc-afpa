<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NationaliteRepository")
 */
class Nationalite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $codeIsoNationalite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Joueur", mappedBy="nationalite")
     */
    private $porter;

    public function __construct()
    {
        $this->porter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getCodeIsoNationalite(): ?string
    {
        return $this->codeIsoNationalite;
    }

    public function setCodeIsoNationalite(string $codeIsoNationalite): self
    {
        $this->codeIsoNationalite = $codeIsoNationalite;

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getPorter(): Collection
    {
        return $this->porter;
    }

    public function addPorter(Joueur $porter): self
    {
        if (!$this->porter->contains($porter)) {
            $this->porter[] = $porter;
            $porter->setNationalite($this);
        }

        return $this;
    }

    public function removePorter(Joueur $porter): self
    {
        if ($this->porter->contains($porter)) {
            $this->porter->removeElement($porter);
            // set the owning side to null (unless already changed)
            if ($porter->getNationalite() === $this) {
                $porter->setNationalite(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string)$this->nationalite;
    }
}
