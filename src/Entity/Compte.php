<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $compteAffaire = null;

    #[ORM\Column(length: 255)]
    private ?string $typeProspect = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Client $Client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteAffaire(): ?string
    {
        return $this->compteAffaire;
    }

    public function setCompteAffaire(string $compteAffaire): static
    {
        $this->compteAffaire = $compteAffaire;

        return $this;
    }

    public function getTypeProspect(): ?string
    {
        return $this->typeProspect;
    }

    public function setTypeProspect(string $typeProspect): static
    {
        $this->typeProspect = $typeProspect;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): static
    {
        $this->Client = $Client;

        return $this;
    }
}
