<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JourneeRepository")
 */
class Journee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $numJournee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matchs", mappedBy="journee")
     */
    private $comprendre;

    public function __construct()
    {
        $this->comprendre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumJournee(): ?string
    {
        return $this->numJournee;
    }

    public function setNumJournee(string $numJournee): self
    {
        $this->numJournee = $numJournee;

        return $this;
    }

    /**
     * @return Collection|Matchs[]
     */
    public function getComprendre(): Collection
    {
        return $this->comprendre;
    }

    public function addComprendre(Matchs $comprendre): self
    {
        if (!$this->comprendre->contains($comprendre)) {
            $this->comprendre[] = $comprendre;
            $comprendre->setJournee($this);
        }

        return $this;
    }

    public function removeComprendre(Matchs $comprendre): self
    {
        if ($this->comprendre->contains($comprendre)) {
            $this->comprendre->removeElement($comprendre);
            // set the owning side to null (unless already changed)
            if ($comprendre->getJournee() === $this) {
                $comprendre->setJournee(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->numJournee;
    }
}
