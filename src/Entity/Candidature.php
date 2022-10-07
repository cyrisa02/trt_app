<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Candidate::class, inversedBy: 'candidatures')]
    private $candidate;

    #[ORM\ManyToOne(targetEntity: Job::class, inversedBy: 'candidatures')]
    private $job;

    

    #[ORM\Column(type: 'boolean')]
    private $isValided;

    #[ORM\Column(nullable: true)]
    private ?bool $isApplied = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    
    public function isIsValided(): ?bool
    {
        return $this->isValided;
    }

    public function setIsValided(bool $isValided): self
    {
        $this->isValided = $isValided;

        return $this;
    }

    public function isIsApplied(): ?bool
    {
        return $this->isApplied;
    }

    public function setIsApplied(?bool $isApplied): self
    {
        $this->isApplied = $isApplied;

        return $this;
    }
}