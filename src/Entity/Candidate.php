<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidateRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: CandidateRepository::class)]
#[Vich\Uploadable]
class Candidate  implements  \Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 190)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 190)]
    private $firstname;

    #[Vich\UploadableField(mapping: 'candidate_cv', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;


    #[ORM\Column(type: 'string', length: 190)]
    private $cvName;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isValided;

    #[ORM\Column(type: 'boolean')]
    private $isRGPD;

    #[ORM\OneToOne(mappedBy: 'candidate', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\OneToMany(mappedBy: 'candidate', targetEntity: Candidature::class)]
    private $candidatures;

    public function serialize() {

return serialize(array(
$this->id,
$this->lastname,
$this->firstname,
$this->isValided,
$this->isRGPD,

));

}

public function unserialize($serialized) {

list (
$this->id,
$this->lastname,
$this->firstname,
$this->isValided,
$this->isRGPD,
) = unserialize($serialized);
}

    

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
    }

     public function __toString()
     {
        return $this->lastname;
          
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    public function getCvName(): ?string
    {
        return $this->cvName;
    }

    public function setCvName(string $cvName): self
    {
        $this->cvName = $cvName;

        return $this;
    }

    public function isIsValided(): ?bool
    {
        return $this->isValided;
    }

    public function setIsValided(?bool $isValided): self
    {
        $this->isValided = $isValided;

        return $this;
    }

    public function isIsRGPD(): ?bool
    {
        return $this->isRGPD;
    }

    public function setIsRGPD(bool $isRGPD): self
    {
        $this->isRGPD = $isRGPD;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCandidate(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCandidate() !== $this) {
            $user->setCandidate($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setCandidate($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getCandidate() === $this) {
                $candidature->setCandidate(null);
            }
        }

        return $this;
    }

    
}