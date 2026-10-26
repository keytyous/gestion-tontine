<?php

namespace App\Entity;

use App\Repository\AdministrateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdministrateurRepository::class)]
class Administrateur extends Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]


    #[ORM\Column]
    private ?\DateTimeImmutable $dateNomination = null;

    #[ORM\Column(length: 100)]
    private ?string $statut = null;

    

    public function getDateNomination(): ?\DateTimeImmutable
    {
        return $this->dateNomination;
    }

    public function setDateNomination(\DateTimeImmutable $dateNomination): static
    {
        $this->dateNomination = $dateNomination;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
