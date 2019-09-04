<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SaisonRepository")
 */
class Saison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $saison;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebutSaison;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFinSaison;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaison(): ?string
    {
        return $this->saison;
    }

    public function setSaison(string $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->saison;
    }

    public function getDateDebutSaison(): ?\DateTimeInterface
    {
        return $this->dateDebutSaison;
    }

    public function setDateDebutSaison(\DateTimeInterface $dateDebutSaison): self
    {
        $this->dateDebutSaison = $dateDebutSaison;

        return $this;
    }

    public function getDateFinSaison(): ?\DateTimeInterface
    {
        return $this->dateFinSaison;
    }

    public function setDateFinSaison(\DateTimeInterface $dateFinSaison): self
    {
        $this->dateFinSaison = $dateFinSaison;

        return $this;
    }
}
