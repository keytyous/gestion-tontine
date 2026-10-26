<?php

namespace App\Entity;

use App\Repository\AdministrateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdministrateurRepository::class)]
class Administrateur extends Membre
{


    #[ORM\Column]
    private ?\DateTimeImmutable $dateNomination = null;

    #[ORM\Column(length: 100)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'administrateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    

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

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(?Groupement $groupement): static
    {
        $this->groupement = $groupement;

        return $this;
    }
}
