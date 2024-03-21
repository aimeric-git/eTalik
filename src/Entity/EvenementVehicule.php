<?php

namespace App\Entity;

use App\Repository\EvenementVehiculeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementVehiculeRepository::class)]
class EvenementVehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $compteEvenement = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $compteDernierEvenement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaireFacturation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroDossier = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable:true)]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\ManyToOne(inversedBy: 'evenementsVehicule')]
    private ?Vehicule $vehicule = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $intermediaireVente = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $origineEvenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteEvenement(): ?string
    {
        return $this->compteEvenement;
    }

    public function setCompteEvenement(?string $compteEvenement): static
    {
        $this->compteEvenement = $compteEvenement;

        return $this;
    }

    public function getCompteDernierEvenement(): ?string
    {
        return $this->compteDernierEvenement;
    }

    public function setCompteDernierEvenement(?string $compteDernierEvenement): static
    {
        $this->compteDernierEvenement = $compteDernierEvenement;

        return $this;
    }

    public function getCommentaireFacturation(): ?string
    {
        return $this->commentaireFacturation;
    }

    public function setCommentaireFacturation(?string $commentaireFacturation): static
    {
        $this->commentaireFacturation = $commentaireFacturation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getNumeroDossier(): ?string
    {
        return $this->numeroDossier;
    }

    public function setNumeroDossier(?string $numeroDossier): static
    {
        $this->numeroDossier = $numeroDossier;

        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(?\DateTimeInterface $dateEvenement): static
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getIntermediaireVente(): ?string
    {
        return $this->intermediaireVente;
    }

    public function setIntermediaireVente(?string $intermediaireVente): static
    {
        $this->intermediaireVente = $intermediaireVente;

        return $this;
    }

    public function getOrigineEvenement(): ?string
    {
        return $this->origineEvenement;
    }

    public function setOrigineEvenement(?string $origineEvenement): static
    {
        $this->origineEvenement = $origineEvenement;

        return $this;
    }
}
