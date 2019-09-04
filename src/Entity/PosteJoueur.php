<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PosteJoueurRepository")
 */
class PosteJoueur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $posteJoueur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Joueur", mappedBy="posteJoueur")
     */
    private $occuper;

    public function __construct()
    {
        $this->occuper = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosteJoueur(): ?string
    {
        return $this->posteJoueur;
    }

    public function setPosteJoueur(string $posteJoueur): self
    {
        $this->posteJoueur = $posteJoueur;

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getOccuper(): Collection
    {
        return $this->occuper;
    }

    public function addOccuper(Joueur $occuper): self
    {
        if (!$this->occuper->contains($occuper)) {
            $this->occuper[] = $occuper;
            $occuper->setPosteJoueur($this);
        }

        return $this;
    }

    public function removeOccuper(Joueur $occuper): self
    {
        if ($this->occuper->contains($occuper)) {
            $this->occuper->removeElement($occuper);
            // set the owning side to null (unless already changed)
            if ($occuper->getPosteJoueur() === $this) {
                $occuper->setPosteJoueur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->posteJoueur;
    }
}
