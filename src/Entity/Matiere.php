<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'float')]
    private $stock;

    #[ORM\Column(type: 'boolean')]
    private $isUnite;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: DetailAchat::class)]
    private $detailAchats;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: DetailPerte::class)]
    private $detailPertes;

    public function __construct()
    {
        $this->detailAchats = new ArrayCollection();
        $this->detailPertes = new ArrayCollection();
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

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getIsUnite(): ?bool
    {
        return $this->isUnite;
    }

    public function setIsUnite(bool $isUnite): self
    {
        $this->isUnite = $isUnite;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, DetailAchat>
     */
    public function getDetailAchats(): Collection
    {
        return $this->detailAchats;
    }

    public function addDetailAchat(DetailAchat $detailAchat): self
    {
        if (!$this->detailAchats->contains($detailAchat)) {
            $this->detailAchats[] = $detailAchat;
            $detailAchat->setMatiere($this);
        }

        return $this;
    }

    public function removeDetailAchat(DetailAchat $detailAchat): self
    {
        if ($this->detailAchats->removeElement($detailAchat)) {
            // set the owning side to null (unless already changed)
            if ($detailAchat->getMatiere() === $this) {
                $detailAchat->setMatiere(null);
            }
        }

        return $this;
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
            $detailPerte->setMatiere($this);
        }

        return $this;
    }

    public function removeDetailPerte(DetailPerte $detailPerte): self
    {
        if ($this->detailPertes->removeElement($detailPerte)) {
            // set the owning side to null (unless already changed)
            if ($detailPerte->getMatiere() === $this) {
                $detailPerte->setMatiere(null);
            }
        }

        return $this;
    }
}
