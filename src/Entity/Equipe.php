<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 * @Vich\Uploadable
 */
class Equipe
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
    private $nomEquipe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Classement", mappedBy="equipe")
     */
    private $classer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Joueur", mappedBy="equipe")
     */
    private $composer;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $stade;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoEquipe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matchs", mappedBy="equipeDomicile")
     */
    private $recevoir;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matchs", mappedBy="equipeExterieur")
     */
    private $deplacer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $updatedAtEquipe;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="equipes", fileNameProperty="logo_equipe")
     * 
     * @var File
     */
    private $imageFile;

    public function __construct()
    {
        $this->composer = new ArrayCollection();
        $this->recevoir = new ArrayCollection();
        $this->deplacer = new ArrayCollection();
        $this->updatedAtSponsor = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(string $nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    /**
     * @return Collection|Classement[]
     */
    public function getClasser(): Collection
    {
        return $this->classer;
    }

    public function addClasser(Classement $classer): self
    {
        if (!$this->classer->contains($classer)) {
            $this->classer[] = $classer;
            $classer->setEquipe($this);
        }

        return $this;
    }

    public function removeClasser(Classement $classer): self
    {
        if ($this->classer->contains($classer)) {
            $this->classer->removeElement($classer);
            // set the owning side to null (unless already changed)
            if ($classer->getEquipe() === $this) {
                $classer->setEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getComposer(): Collection
    {
        return $this->composer;
    }

    public function addComposer(Joueur $composer): self
    {
        if (!$this->composer->contains($composer)) {
            $this->composer[] = $composer;
            $composer->setEquipe($this);
        }

        return $this;
    }

    public function removeComposer(Joueur $composer): self
    {
        if ($this->composer->contains($composer)) {
            $this->composer->removeElement($composer);
            // set the owning side to null (unless already changed)
            if ($composer->getEquipe() === $this) {
                $composer->setEquipe(null);
            }
        }

        return $this;
    }

    public function getStade(): ?string
    {
        return $this->stade;
    }

    public function setStade(string $stade): self
    {
        $this->stade = $stade;

        return $this;
    }

    public function getLogoEquipe(): ?string
    {
        return $this->logoEquipe;
    }

    public function setLogoEquipe(? string $logoEquipe): self
    {
        $this->logoEquipe = $logoEquipe;

        return $this;
    }

    /**
     * @return Collection|Matchs[]
     */
    public function getRecevoir(): Collection
    {
        return $this->recevoir;
    }

    public function addRecevoir(Matchs $recevoir): self
    {
        if (!$this->recevoir->contains($recevoir)) {
            $this->recevoir[] = $recevoir;
            $recevoir->setEquipeDomicile($this);
        }

        return $this;
    }

    public function removeRecevoir(Matchs $recevoir): self
    {
        if ($this->recevoir->contains($recevoir)) {
            $this->recevoir->removeElement($recevoir);
            // set the owning side to null (unless already changed)
            if ($recevoir->getEquipeDomicile() === $this) {
                $recevoir->setEquipeDomicile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Matchs[]
     */
    public function getDeplacer(): Collection
    {
        return $this->deplacer;
    }

    public function addDeplacer(Matchs $deplacer): self
    {
        if (!$this->deplacer->contains($deplacer)) {
            $this->deplacer[] = $deplacer;
            $deplacer->setEquipeExterieur($this);
        }

        return $this;
    }

    public function removeDeplacer(Matchs $deplacer): self
    {
        if ($this->deplacer->contains($deplacer)) {
            $this->deplacer->removeElement($deplacer);
            // set the owning side to null (unless already changed)
            if ($deplacer->getEquipeExterieur() === $this) {
                $deplacer->setEquipeExterieur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->nomEquipe;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtSponsor = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getupdatedAtEquipe(): ?\DateTimeInterface
    {
        return $this->updatedAtEquipe;
    }

    public function setupdatedAtEquipe(\DateTimeInterface $updatedAtSponsor): self
    {
        $this->updatedAtEquipe = $updatedAtEquipe;

        return $this;
    }
}
