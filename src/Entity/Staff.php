<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StaffRepository")
 * @Vich\Uploadable
 */
class Staff
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
    private $nomStaff;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomStaff;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $roleStaff;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionStaff;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageStaff;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="staffs", fileNameProperty="image_staff")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtStaff;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStaff(): ?string
    {
        return $this->nomStaff;
    }

    public function setNomStaff(string $nomStaff): self
    {
        $this->nomStaff = $nomStaff;

        return $this;
    }

    public function getPrenomStaff(): ?string
    {
        return $this->prenomStaff;
    }

    public function setPrenomStaff(string $prenomStaff): self
    {
        $this->prenomStaff = $prenomStaff;

        return $this;
    }

    public function getRoleStaff(): ?string
    {
        return $this->roleStaff;
    }

    public function setRoleStaff(string $roleStaff): self
    {
        $this->roleStaff = $roleStaff;

        return $this;
    }

    public function getDescriptionStaff(): ?string
    {
        return $this->descriptionStaff;
    }

    public function setDescriptionStaff(?string $descriptionStaff): self
    {
        $this->descriptionStaff = $descriptionStaff;

        return $this;
    }

    public function getImageStaff(): ?string
    {
        return $this->imageStaff;
    }

    public function setImageStaff(?string $imageStaff): self
    {
        $this->imageStaff = $imageStaff;

        return $this;
    }

    public function __construct()
    {
        $this->updatedAtStaff = new \DateTime();
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
            $this->updatedAtStaff = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getupdatedAtStaff(): ?\DateTimeInterface
    {
        return $this->updatedAtStaff;
    }

    public function setupdatedAtStaff(\DateTimeInterface $updatedAtStaff): self
    {
        $this->updatedAtStaff = $updatedAtStaff;

        return $this;
    }
}
