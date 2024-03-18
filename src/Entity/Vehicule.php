<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numeroFiche = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateMiseEnCirculation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAchat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDernierEvenement = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleMarque = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleModele = null;

    #[ORM\Column(length: 255)]
    private ?string $version = null;

    #[ORM\Column(length: 255)]
    private ?string $VIN = null;

    #[ORM\Column(length: 255)]
    private ?string $immatriculation = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleEnergie = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    private ?Client $Client = null;

    #[ORM\ManyToOne]
    private ?Vendeur $vendeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroFiche(): ?int
    {
        return $this->numeroFiche;
    }

    public function setNumeroFiche(int $numeroFiche): static
    {
        $this->numeroFiche = $numeroFiche;

        return $this;
    }

    public function getDateMiseEnCirculation(): ?\DateTimeInterface
    {
        return $this->dateMiseEnCirculation;
    }

    public function setDateMiseEnCirculation(\DateTimeInterface $dateMiseEnCirculation): static
    {
        $this->dateMiseEnCirculation = $dateMiseEnCirculation;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getDateDernierEvenement(): ?\DateTimeInterface
    {
        return $this->dateDernierEvenement;
    }

    public function setDateDernierEvenement(\DateTimeInterface $dateDernierEvenement): static
    {
        $this->dateDernierEvenement = $dateDernierEvenement;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): static
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getLibelleMarque(): ?string
    {
        return $this->libelleMarque;
    }

    public function setLibelleMarque(string $libelleMarque): static
    {
        $this->libelleMarque = $libelleMarque;

        return $this;
    }

    public function getLibelleModele(): ?string
    {
        return $this->libelleModele;
    }

    public function setLibelleModele(string $libelleModele): static
    {
        $this->libelleModele = $libelleModele;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVIN(): ?string
    {
        return $this->VIN;
    }

    public function setVIN(string $VIN): static
    {
        $this->VIN = $VIN;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getLibelleEnergie(): ?string
    {
        return $this->libelleEnergie;
    }

    public function setLibelleEnergie(string $libelleEnergie): static
    {
        $this->libelleEnergie = $libelleEnergie;

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

    public function getVendeur(): ?Vendeur
    {
        return $this->vendeur;
    }

    public function setVendeur(?Vendeur $vendeur): static
    {
        $this->vendeur = $vendeur;

        return $this;
    }
}
