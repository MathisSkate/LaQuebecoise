<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\OneToMany(mappedBy: 'achat', targetEntity: DetailAchat::class)]
    private $detailAchats;

    public function __construct()
    {
        $this->detailAchats = new ArrayCollection();
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function __toString(): string
    {
        return $this -> getDate() -> format('d/m/Y');
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
            $detailAchat->setAchat($this);
        }

        return $this;
    }

    public function removeDetailAchat(DetailAchat $detailAchat): self
    {
        if ($this->detailAchats->removeElement($detailAchat)) {
            // set the owning side to null (unless already changed)
            if ($detailAchat->getAchat() === $this) {
                $detailAchat->setAchat(null);
            }
        }

        return $this;
    }
}
