<?php

namespace App\Entity;

use App\Repository\CustomerRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRequestRepository::class)]
class CustomerRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'customerRequests')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Exhibitor $exhibitor = null;

    #[ORM\ManyToOne(inversedBy: 'customerRequests')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Stand $stand = null;

    /**
     * @var Collection<int, RequestedItems>
     */
    #[ORM\OneToMany(targetEntity: RequestedItems::class,mappedBy: 'customerRequest',orphanRemoval: true,cascade: ['persist'])]
    private Collection $requestedItems;

    #[ORM\Column(nullable: true)]
    private ?int $progress_report = null;

    #[ORM\ManyToOne(inversedBy: 'customerRequests')]
    private ?Provider $provider = null;

    #[ORM\OneToOne(mappedBy: 'customerRequest', cascade: ['persist'], orphanRemoval: false)]
    private ?ResponseProvider $responseProvider = null;

    #[ORM\Column(nullable: true)]
    private ?int $chair = null;

    #[ORM\Column(nullable: true)]
    private ?int $tableStand = null;

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

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $extra = null;

    #[ORM\Column(nullable: true)]
    private ?int $tribleSocket = null;

    #[ORM\Column(nullable: true)]
    private ?int $rod = null;

    #[ORM\Column(nullable: true)]
    private ?int $sqm = null;

    public function __toString(): string
    {
        return 'Customer Request '.$this->getExhibitor();
    }

    public function __construct()
    {
        $this->requestedItems = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExhibitor(): ?Exhibitor
    {
        return $this->exhibitor;
    }

    public function setExhibitor(?Exhibitor $exhibitor): static
    {
        $this->exhibitor = $exhibitor;

        return $this;
    }

    public function getStand(): ?Stand
    {
        return $this->stand;
    }

    public function setStand(?Stand $stand): static
    {
        $this->stand = $stand;

        return $this;
    }

    /**
     * @return Collection<int, RequestedItems>
     */
    public function getRequestedItems(): Collection
    {
        return $this->requestedItems;
    }

    
    public function addRequestedItem(RequestedItems $requestedItem): static
    {
        if (!$this->requestedItems->contains($requestedItem)) {
            $this->requestedItems->add($requestedItem);
            $requestedItem->setCustomerRequest($this);
        }

        return $this;
    }

    public function removeRequestedItem(RequestedItems $requestedItem): static
    {
        if ($this->requestedItems->removeElement($requestedItem)) {
            // set the owning side to null (unless already changed)
            if ($requestedItem->getCustomerRequest() === $this) {
                $requestedItem->setCustomerRequest(null);
            }
        }

        return $this;
    }
   

    public function getProgressReport(): ?int
    {
        return $this->progress_report;
    }

    public function setProgressReport(?int $progress_report): static
    {
        $this->progress_report = $progress_report;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getResponseProvider(): ?ResponseProvider
    {
        return $this->responseProvider;
    }

    public function setResponseProvider(?ResponseProvider $responseProvider): static
    {
        // unset the owning side of the relation if necessary
        if ($responseProvider === null && $this->responseProvider !== null) {
            $this->responseProvider->setCustomerRequest(null);
        }

        // set the owning side of the relation if necessary
        if ($responseProvider !== null && $responseProvider->getCustomerRequest() !== $this) {
            $responseProvider->setCustomerRequest($this);
        }

        $this->responseProvider = $responseProvider;

        return $this;
    }

    
    public function getExtra(): ?string
    {
        return $this->extra;
    }

    public function setExtra(?string $extra): static
    {
        $this->extra = $extra;

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

    public function getTableStand(): ?int
    {
        return $this->tableStand;
    }

    public function setTableStand(?int $tableStand): static
    {
        $this->tableStand = $tableStand;

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

    public function getRod(): ?int
    {
        return $this->rod;
    }

    public function setRod(?int $rod): static
    {
        $this->rod = $rod;

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

    public function getTribleSocket(): ?int
    {
        return $this->tribleSocket;
    }

    public function setTribleSocket(?int $tribleSocket): static
    {
        $this->tribleSocket = $tribleSocket;

        return $this;
    }

    public function getSqm(): ?int
    {
        return $this->sqm;
    }

    public function setSqm(?int $sqm): static
    {
        $this->sqm = $sqm;

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

    public function getWallHanger(): ?int
    {
        return $this->wallHanger;
    }

    public function setWallHanger(?int $wallHanger): static
    {
        $this->wallHanger = $wallHanger;

        return $this;
    }
  
}
