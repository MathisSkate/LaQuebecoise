<?php

namespace App\Entity;

use App\Repository\DetailPerteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailPerteRepository::class)]
class DetailPerte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Perte::class, inversedBy: 'detailPertes')]
    private $perte;

    #[ORM\ManyToOne(targetEntity: Matiere::class, inversedBy: 'detailPertes')]
    private $matiere;

    #[ORM\Column(type: 'float')]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerte(): ?Perte
    {
        return $this->perte;
    }

    public function setPerte(?Perte $perte): self
    {
        $this->perte = $perte;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
