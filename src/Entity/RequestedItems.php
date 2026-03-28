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
    private ?int $wallHanger = null;

    #[ORM\Column(nullable: true)]
    private ?int $shelf = null;

    #[ORM\Column(nullable: true)]
    private ?int $electricPlug = null;

    #[ORM\Column(nullable: true)]
    private ?int $carpet = null;

    #[ORM\ManyToOne(inversedBy: 'requested_items')]
    private ?ResponseProvider $responseProvider = null;

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

    public function getWallHanger(): ?int
    {
        return $this->wallHanger;
    }

    public function setWallHanger(?int $wallHanger): static
    {
        $this->wallHanger = $wallHanger;

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

    public function getElectricPlug(): ?int
    {
        return $this->electricPlug;
    }

    public function setElectricPlug(?int $electricPlug): static
    {
        $this->electricPlug = $electricPlug;

        return $this;
    }

    public function getCarpet(): ?int
    {
        return $this->carpet;
    }

    public function setCarpet(?int $carpet): static
    {
        $this->carpet = $carpet;

        return $this;
    }

    public function getResponseProvider(): ?ResponseProvider
    {
        return $this->responseProvider;
    }

    public function setResponseProvider(?ResponseProvider $responseProvider): static
    {
        $this->responseProvider = $responseProvider;

        return $this;
    }
}