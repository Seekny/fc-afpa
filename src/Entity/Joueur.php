<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 * @Vich\Uploadable
 */
class Joueur
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
    private $nomJoueur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenomJoueur;

    /**
     * @ORM\Column(type="integer")
     */
    private $ageJoueur;

    /**
     * @ORM\Column(type="integer")
     */
    private $numMaillotJoueur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="composer")
     */
    private $equipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PosteJoueur", inversedBy="occuper")
     * @ORM\JoinColumn(nullable=false)
     */
    private $posteJoueur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Matchs")
     */
    private $jouer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nationalite", inversedBy="porter")
     */
    private $nationalite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionJoueur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageJoueur;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="joueurs", fileNameProperty="imageJoueur")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtJoueur;

    public function getupdatedAtJoueur(): ?\DateTimeInterface
    {
        return $this->updatedAtJoueur;
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
            $this->updatedAtJoueur = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function __construct()
    {
        $this->jouer = new ArrayCollection();
        $this->updatedAtJoueur = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJoueur(): ?string
    {
        return $this->nomJoueur;
    }

    public function setNomJoueur(string $nomJoueur): self
    {
        $this->nomJoueur = $nomJoueur;

        return $this;
    }

    public function getPrenomJoueur(): ?string
    {
        return $this->prenomJoueur;
    }

    public function setPrenomJoueur(?string $prenomJoueur): self
    {
        $this->prenomJoueur = $prenomJoueur;

        return $this;
    }

    public function getAgeJoueur(): ?int
    {
        return $this->ageJoueur;
    }

    public function setAgeJoueur(int $ageJoueur): self
    {
        $this->ageJoueur = $ageJoueur;

        return $this;
    }

    public function getNumMaillotJoueur(): ?int
    {
        return $this->numMaillotJoueur;
    }

    public function setNumMaillotJoueur(int $numMaillotJoueur): self
    {
        $this->numMaillotJoueur = $numMaillotJoueur;

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

    public function getPosteJoueur(): ?PosteJoueur
    {
        return $this->posteJoueur;
    }

    public function setPosteJoueur(?PosteJoueur $posteJoueur): self
    {
        $this->posteJoueur = $posteJoueur;

        return $this;
    }

    /**
     * @return Collection|Matchs[]
     */
    public function getJouer(): Collection
    {
        return $this->jouer;
    }

    public function addJouer(Matchs $jouer): self
    {
        if (!$this->jouer->contains($jouer)) {
            $this->jouer[] = $jouer;
        }

        return $this;
    }

    public function removeJouer(Matchs $jouer): self
    {
        if ($this->jouer->contains($jouer)) {
            $this->jouer->removeElement($jouer);
        }

        return $this;
    }

    public function getNationalite(): ?Nationalite
    {
        return $this->nationalite;
    }

    public function setNationalite(?Nationalite $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getDescriptionJoueur(): ?string
    {
        return $this->descriptionJoueur;
    }

    public function setDescriptionJoueur(?string $descriptionJoueur): self
    {
        $this->descriptionJoueur = $descriptionJoueur;

        return $this;
    }

    public function getImageJoueur(): ?string
    {
        return $this->imageJoueur;
    }

    public function setImageJoueur(?string $imageJoueur): self
    {
        $this->imageJoueur = $imageJoueur;

        return $this;
    }

    public function setupdatedAtJoueur(\DateTimeInterface $updatedAtJoueur): self
    {
        $this->updatedAtJoueur = $updatedAtJoueur;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->nomJoueur;
    }
}
