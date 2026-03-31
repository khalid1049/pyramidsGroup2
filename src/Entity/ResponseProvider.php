<?php

namespace App\Entity;

use App\Repository\ResponseProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseProviderRepository::class)]
class ResponseProvider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'responseProvider', cascade: ['persist'])]
    private ?Stand $stand = null;

 
    /**
     * @var Collection<int, RequestedItems>
     */
    #[ORM\OneToMany(targetEntity: RequestedItems::class,mappedBy: 'responseProvider',orphanRemoval: true,cascade: ['persist'])]
    private Collection $requestedItems;

    #[ORM\Column(nullable: true)]
    private ?int $progress_report = null;

    #[ORM\ManyToOne(inversedBy: 'responseProviders')]
    private ?Provider $provider = null;

    #[ORM\OneToOne(inversedBy: 'responseProvider', cascade: ['persist', 'remove'])]
    private ?Exhibitor $exhibitor = null;

    #[ORM\OneToOne(inversedBy: 'responseProvider', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?CustomerRequest $customerRequest = null;

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
    private ?int $sqm = null;

    #[ORM\Column(nullable: true)]
    private ?int $tribleSocket = null;

    #[ORM\Column(nullable: true)]
    private ?int $rod = null;

    #[ORM\Column(nullable: true)]
    private ?bool $inProgress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoStand = null;

    public function __construct()
    {   
        // $this->customerRequest = new CustomerRequest();
        $this->requestedItems = new ArrayCollection();
        $this->inProgress = true;
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $requestedItem->setResponseProvider($this);
        }

        return $this;
    }

    public function removeRequestedItem(RequestedItems $requestedItem): static
    {
        if ($this->requestedItems->removeElement($requestedItem)) {
            // set the owning side to null (unless already changed)
            if ($requestedItem->getResponseProvider() === $this) {
                $requestedItem->setResponseProvider(null);
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
    
    public function getExhibitor()
    {
        return $this->customerRequest?->getExhibitor();
    }

    public function setExhibitor(?Exhibitor $exhibitor): static
    {
        $this->exhibitor = $exhibitor;

        return $this;
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

    public function isInProgress(): ?bool
    {
        return $this->inProgress;
    }

    public function setInProgress(?bool $inProgress): static
    {
        $this->inProgress = $inProgress;

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

    public function getProgressPercentage(): int
    {
        $customer = $this->customerRequest;
        // dd($customer);

        if (!$customer) {
            return 0; // ila ma kaynch customer, 0%
        }

        $fields = [
            'chair',
            'tableStand',
            'spot',
            'wallHanger',
            'shelf',
            'electricPlug',
            'carpet',
            'tribleSocket',
            'rod',
            'sqm'
        ];

        $total = 0; // total items demande
        $done = 0;  // total items provider jawb 3lihom

        foreach ($fields as $field) {
            $getter = 'get' . ucfirst($field);

            $customerValue = method_exists($customer, $getter) ? $customer->$getter() : null;
            $providerValue = method_exists($this, $getter) ? $this->$getter() : null;

            if ($customerValue !== null) {
                $total += 1;
                if ($providerValue !== null && $providerValue >= $customerValue) {
                    $done += 1;
                } elseif ($providerValue !== null && $providerValue > 0) {
                    $done += 0.5; // partial
                }
            }
        }

        if ($total === 0) {
            return 0;
        }

        return (int)(($done / $total) * 100);
    }

    public function getPhotoStand(): ?string
    {
        return $this->photoStand;
    }

    public function setPhotoStand(?string $photoStand): static
    {
        $this->photoStand = $photoStand;

        return $this;
    }
}
