<?php

namespace App\Entity;

use App\Repository\RequestedItemsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestedItemsRepository::class)]
class RequestedItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'requestedItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CustomerRequest $customerRequest = null;

    #[ORM\Column(nullable: true)]
    private ?int $chair = null;

    #[ORM\Column(nullable: true)]
    private ?int $tables = null;

    #[ORM\Column(nullable: true)]
    private ?int $spot = null;

    #[ORM\Column(nullable: true)]
    private ?int $info = null;

    #[ORM\Column(nullable: true)]
    private ?int $shelf = null;

    #[ORM\Column(nullable: true)]
    private ?int $cabin = null;

    #[ORM\Column(nullable: true)]
    private ?int $showcase = null;

    #[ORM\Column(nullable: true)]
    private ?int $trible_scoket = null;

    #[ORM\Column(nullable: true)]
    private ?int $brochure_stand = null;

    #[ORM\Column(nullable: true)]
    private ?int $bar_chair = null;

    public function __toString(): string
    {
        return 'Requested Item '.$this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerRequest(): ?CustomerRequest
    {
        return $this->customerRequest;
    }

    public function setCustomerRequest(?CustomerRequest $customerRequest): static
    {
        $this->customerRequest = $customerRequest;

        return $this;
    }

    public function getChair(): ?int
    {
        return $this->chair;
    }

    public function setChair(?int $chair): static
    {
        $this->chair = $chair;

        return $this;
    }

    public function getTables(): ?int
    {
        return $this->tables;
    }

    public function setTables(?int $tables): static
    {
        $this->tables = $tables;

        return $this;
    }

    public function getSpot(): ?int
    {
        return $this->spot;
    }

    public function setSpot(?int $spot): static
    {
        $this->spot = $spot;

        return $this;
    }

    public function getInfo(): ?int
    {
        return $this->info;
    }

    public function setInfo(?int $info): static
    {
        $this->info = $info;

        return $this;
    }

    public function getShelf(): ?int
    {
        return $this->shelf;
    }

    public function setShelf(?int $shelf): static
    {
        $this->shelf = $shelf;

        return $this;
    }

    public function getCabin(): ?int
    {
        return $this->cabin;
    }

    public function setCabin(?int $cabin): static
    {
        $this->cabin = $cabin;

        return $this;
    }

    public function getShowcase(): ?int
    {
        return $this->showcase;
    }

    public function setShowcase(?int $showcase): static
    {
        $this->showcase = $showcase;

        return $this;
    }

    public function getTribleScoket(): ?int
    {
        return $this->trible_scoket;
    }

    public function setTribleScoket(?int $trible_scoket): static
    {
        $this->trible_scoket = $trible_scoket;

        return $this;
    }

    public function getBrochureStand(): ?int
    {
        return $this->brochure_stand;
    }

    public function setBrochureStand(?int $brochure_stand): static
    {
        $this->brochure_stand = $brochure_stand;

        return $this;
    }

    public function getBarChair(): ?int
    {
        return $this->bar_chair;
    }

    public function setBarChair(?int $bar_chair): static
    {
        $this->bar_chair = $bar_chair;

        return $this;
    }
}
