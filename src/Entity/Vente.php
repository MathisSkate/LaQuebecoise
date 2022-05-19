<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\OneToMany(mappedBy: 'vente', targetEntity: DetailVente::class)]
    private $detailVentes;

    public function __construct()
    {
        $this->detailVentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function __toString(): string
    {
        return $this -> getDate() -> format('d/m/Y');
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
            $detailVente->setVente($this);
        }

        return $this;
    }

    public function removeDetailVente(DetailVente $detailVente): self
    {
        if ($this->detailVentes->removeElement($detailVente)) {
            // set the owning side to null (unless already changed)
            if ($detailVente->getVente() === $this) {
                $detailVente->setVente(null);
            }
        }

        return $this;
    }
}
