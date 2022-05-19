<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: DetailVente::class)]
    private $detailVentes;

    public function __construct()
    {
        $this->detailVentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, DetailVente>
     */
    public function getDetailVentes(): Collection
    {
        return $this->detailVentes;
    }

    public function addDetailVente(DetailVente $detailVente): self
    {
        if (!$this->detailVentes->contains($detailVente)) {
            $this->detailVentes[] = $detailVente;
            $detailVente->setProduit($this);
        }

        return $this;
    }

    public function removeDetailVente(DetailVente $detailVente): self
    {
        if ($this->detailVentes->removeElement($detailVente)) {
            // set the owning side to null (unless already changed)
            if ($detailVente->getProduit() === $this) {
                $detailVente->setProduit(null);
            }
        }

        return $this;
    }
}
