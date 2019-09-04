<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassementRepository")
 */
class Classement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $positionClassement;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointsClassement;

    /**
     * @ORM\Column(type="integer")
     */
    private $butsMarques;

    /**
     * @ORM\Column(type="integer")
     */
    private $butsEncaisses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="classer")
     */
    private $equipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="impliquer")
     */
    private $competition;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchsJoue;

    /**
     * @ORM\Column(type="integer")
     */
    private $victoires;

    /**
     * @ORM\Column(type="integer")
     */
    private $defaites;

    /**
     * @ORM\Column(type="integer")
     */
    private $nuls;

    /**
     * @ORM\Column(type="integer")
     */
    private $differenceButs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupeClassement", inversedBy="impliquer")
     */
    private $groupeClassement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPositionClassement(): ?int
    {
        return $this->positionClassement;
    }

    public function setPositionClassement(int $positionClassement): self
    {
        $this->positionClassement = $positionClassement;

        return $this;
    }

    public function getPointsClassement(): ?int
    {
        return $this->pointsClassement;
    }

    public function setPointsClassement(int $pointsClassement): self
    {
        $this->pointsClassement = $pointsClassement;

        return $this;
    }

    public function getButsMarques(): ?int
    {
        return $this->butsMarques;
    }

    public function setButsMarques(int $butsMarques): self
    {
        $this->butsMarques = $butsMarques;

        return $this;
    }

    public function getButsEncaisses(): ?int
    {
        return $this->butsEncaisses;
    }

    public function setButsEncaisses(int $butsEncaisses): self
    {
        $this->butsEncaisses = $butsEncaisses;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    public function getMatchsJoue(): ?int
    {
        return $this->matchsJoue;
    }

    public function setMatchsJoue(?int $matchsJoue): self
    {
        $this->matchsJoue = $matchsJoue;

        return $this;
    }

    public function getVictoires(): ?int
    {
        return $this->victoires;
    }

    public function setVictoires(?int $victoires): self
    {
        $this->victoires = $victoires;

        return $this;
    }

    public function getDefaites(): ?int
    {
        return $this->defaites;
    }

    public function setDefaites(?int $defaites): self
    {
        $this->defaites = $defaites;

        return $this;
    }

    public function getNuls(): ?int
    {
        return $this->nuls;
    }

    public function setNuls(?int $nuls): self
    {
        $this->nuls = $nuls;

        return $this;
    }

    public function getDifferenceButs(): ?int
    {
        return $this->differenceButs;
    }

    public function setDifferenceButs(int $differenceButs): self
    {
        $this->differenceButs = $differenceButs;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getGroupeClassement(): ?GroupeClassement
    {
        return $this->groupeClassement;
    }

    public function setGroupeClassement(?GroupeClassement $groupeClassement): self
    {
        $this->groupeClassement = $groupeClassement;

        return $this;
    }
}
