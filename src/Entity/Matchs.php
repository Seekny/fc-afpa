<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchsRepository")
 */
class Matchs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMatch;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resumeMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreEquipeDom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreEquipeExt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Journee", inversedBy="comprendre")
     */
    private $journee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="recevoir")
     * @ORM\JoinColumn(nullable=true)
     */
    private $equipeDomicile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="deplacer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $equipeExterieur;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="disposer")
     */
    private $competition;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $resultatMatch;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupeClassement", inversedBy="grouper")
     */
    private $groupeClassement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMatch(): ?\DateTimeInterface
    {
        return $this->dateMatch;
    }

    public function setDateMatch(\DateTimeInterface $dateMatch): self
    {
        $this->dateMatch = $dateMatch;

        return $this;
    }

    public function getResumeMatch(): ?string
    {
        return $this->resumeMatch;
    }

    public function setResumeMatch(?string $resumeMatch): self
    {
        $this->resumeMatch = $resumeMatch;

        return $this;
    }

    public function getScoreEquipeDom(): ?int
    {
        return $this->scoreEquipeDom;
    }

    public function setScoreEquipeDom(?int $scoreEquipeDom): self
    {
        $this->scoreEquipeDom = $scoreEquipeDom;

        return $this;
    }

    public function getScoreEquipeExt(): ?int
    {
        return $this->scoreEquipeExt;
    }

    public function setScoreEquipeExt(?int $scoreEquipeExt): self
    {
        $this->scoreEquipeExt = $scoreEquipeExt;

        return $this;
    }

    public function getJournee(): ?Journee
    {
        return $this->journee;
    }

    public function setJournee(?Journee $journee): self
    {
        $this->journee = $journee;

        return $this;
    }

    public function getEquipeDomicile(): ?Equipe
    {
        return $this->equipeDomicile;
    }

    public function setEquipeDomicile(?Equipe $equipeDomicile): self
    {
        $this->equipeDomicile = $equipeDomicile;

        return $this;
    }

    public function getEquipeExterieur(): ?Equipe
    {
        return $this->equipeExterieur;
    }

    public function setEquipeExterieur(?Equipe $equipeExterieur): self
    {
        $this->equipeExterieur = $equipeExterieur;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

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

    public function __toString()
    {
        return (string)$this->titre;
        return (string)$this->id;
    }

    public function getResultatMatch(): ?string
    {
        return $this->resultatMatch;
    }

    public function setResultatMatch(?string $resultatMatch): self
    {
        $this->resultatMatch = $resultatMatch;

        return $this;
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