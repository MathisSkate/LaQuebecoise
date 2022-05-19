<?php

namespace App\Entity;

use App\Repository\PerteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerteRepository::class)]
class Perte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\OneToMany(mappedBy: 'perte', targetEntity: DetailPerte::class)]
    private $detailPertes;

    public function __construct()
    {
        $this->detailPertes = new ArrayCollection();
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
     * @return Collection<int, DetailPerte>
     */
    public function getDetailPertes(): Collection
    {
        return $this->detailPertes;
    }

    public function addDetailPerte(DetailPerte $detailPerte): self
    {
        if (!$this->detailPertes->contains($detailPerte)) {
            $this->detailPertes[] = $detailPerte;
            $detailPerte->setPerte($this);
        }

        return $this;
    }

    public function removeDetailPerte(DetailPerte $detailPerte): self
    {
        if ($this->detailPertes->removeElement($detailPerte)) {
            // set the owning side to null (unless already changed)
            if ($detailPerte->getPerte() === $this) {
                $detailPerte->setPerte(null);
            }
        }

        return $this;
    }
}
