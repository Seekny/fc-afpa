<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomCompetition;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateDebutCompet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateFinCompet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Classement", mappedBy="competition")
     */
    private $impliquer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Journee")
     */
    private $comporter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matchs", mappedBy="competition")
     */
    private $disposer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Saison")
     */
    private $englober;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Equipe")
     */
    private $participer;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomCompetitionCourt;

    public function __construct()
    {
        $this->impliquer = new ArrayCollection();
        $this->comporter = new ArrayCollection();
        $this->disposer = new ArrayCollection();
        $this->participer = new ArrayCollection();
        $this->englober = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCompetition(): ?string
    {
        return $this->nomCompetition;
    }

    public function setNomCompetition(string $nomCompetition): self
    {
        $this->nomCompetition = $nomCompetition;

        return $this;
    }

    public function getDateDebutCompet(): ?\DateTimeInterface
    {
        return $this->DateDebutCompet;
    }

    public function setDateDebutCompet(\DateTimeInterface $DateDebutCompet): self
    {
        $this->DateDebutCompet = $DateDebutCompet;

        return $this;
    }

    public function getDateFinCompet(): ?\DateTimeInterface
    {
        return $this->DateFinCompet;
    }

    public function setDateFinCompet(\DateTimeInterface $DateFinCompet): self
    {
        $this->DateFinCompet = $DateFinCompet;

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
            $impliquer->setCompetition($this);
        }

        return $this;
    }

    public function removeImpliquer(Classement $impliquer): self
    {
        if ($this->impliquer->contains($impliquer)) {
            $this->impliquer->removeElement($impliquer);
            // set the owning side to null (unless already changed)
            if ($impliquer->getCompetition() === $this) {
                $impliquer->setCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Journee[]
     */
    public function getComporter(): Collection
    {
        return $this->comporter;
    }

    public function addComporter(Journee $comporter): self
    {
        if (!$this->comporter->contains($comporter)) {
            $this->comporter[] = $comporter;
        }

        return $this;
    }

    public function removeComporter(Journee $comporter): self
    {
        if ($this->comporter->contains($comporter)) {
            $this->comporter->removeElement($comporter);
        }

        return $this;
    }

    /**
     * @return Collection|Matchs[]
     */
    public function getDisposer(): Collection
    {
        return $this->disposer;
    }

    public function addDisposer(Matchs $disposer): self
    {
        if (!$this->disposer->contains($disposer)) {
            $this->disposer[] = $disposer;
            $disposer->setCompetition($this);
        }

        return $this;
    }

    public function removeDisposer(Matchs $disposer): self
    {
        if ($this->disposer->contains($disposer)) {
            $this->disposer->removeElement($disposer);
            // set the owning side to null (unless already changed)
            if ($disposer->getCompetition() === $this) {
                $disposer->setCompetition(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->nomCompetition;
    }

    /**
     * @return Collection|Saison[]
     */
    public function getEnglober(): Collection
    {
        return $this->englober;
    }

    public function addEnglober(Saison $englober): self
    {
        if (!$this->englober->contains($englober)) {
            $this->englober[] = $englober;
        }

        return $this;
    }

    public function removeEnglober(Saison $englober): self
    {
        if ($this->englober->contains($englober)) {
            $this->englober->removeElement($englober);
        }

        return $this;
    }

    /**
     * @return Collection|Equipe[]
     */
    public function getParticiper(): Collection
    {
        return $this->participer;
    }

    public function addParticiper(Equipe $participer): self
    {
        if (!$this->participer->contains($participer)) {
            $this->participer[] = $participer;
        }

        return $this;
    }

    public function removeParticiper(Equipe $participer): self
    {
        if ($this->participer->contains($participer)) {
            $this->participer->removeElement($participer);
        }

        return $this;
    }

    public function getNomCompetitionCourt(): ?string
    {
        return $this->nomCompetitionCourt;
    }

    public function setNomCompetitionCourt(?string $nomCompetitionCourt): self
    {
        $this->nomCompetitionCourt = $nomCompetitionCourt;

        return $this;
    }
}
