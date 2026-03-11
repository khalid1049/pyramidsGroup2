<?php

namespace App\Entity;

use App\Repository\StandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StandRepository::class)]
class Stand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surface = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column (nullable: true)]
    private ?bool $status = null;

    #[ORM\OneToOne(inversedBy: 'stand', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exhibitor $exhibitor = null;

    // public function __construct()
    // {   
    //     $this->exhibitor = new Exhibitor();
    // }
    public function __toString(): string
    {
        return 'Stand '.$this->number;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(?string $surface): static
    {
        $this->surface = $surface;

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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getExhibitor(): ?Exhibitor
    {
        return $this->exhibitor;
    }

    public function setExhibitor(Exhibitor $exhibitor): static
    {
        $this->exhibitor = $exhibitor;

        return $this;
    }
}
