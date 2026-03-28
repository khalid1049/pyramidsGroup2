<?php

namespace App\Entity;

use App\Repository\ResponseProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseProviderRepository::class)]
class ResponseProvider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'responseProvider', cascade: ['persist', 'remove'])]
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

    #[ORM\OneToOne(inversedBy: 'responseProvider', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?CustomerRequest $customerRequest = null;

    public function __construct()
    {   
        // $this->customerRequest = new CustomerRequest();
        $this->requestedItems = new ArrayCollection();
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
}
