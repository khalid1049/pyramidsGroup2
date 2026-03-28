<?php

namespace App\Entity;

use App\Repository\CustomerRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToOne(mappedBy: 'customerRequest', cascade: ['persist', 'remove'])]
    private ?ResponseProvider $responseProvider = null;

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

  
}
