<?php

namespace App\Entity;

use App\Repository\ConsultantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultantRepository::class)]
class Consultant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    
    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $tel;

    #[ORM\OneToOne(mappedBy: 'consultant', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

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
            $this->user->setConsultant(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getConsultant() !== $this) {
            $user->setConsultant($this);
        }

        $this->user = $user;

        return $this;
    }
}