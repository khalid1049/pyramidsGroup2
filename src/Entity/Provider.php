<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
class Provider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activityType = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $serviceOffered = null;

    #[ORM\OneToOne(inversedBy: 'provider', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, CustomerRequest>
     */
    #[ORM\OneToMany(targetEntity: CustomerRequest::class, mappedBy: 'provider')]
    private Collection $customerRequests;

    /**
     * @var Collection<int, ResponseProvider>
     */
    #[ORM\OneToMany(targetEntity: ResponseProvider::class, mappedBy: 'provider')]
    private Collection $responseProviders;

    public function __construct()
    {   
        $this->user = new User();
        $this->customerRequests = new ArrayCollection();
        $this->responseProviders = new ArrayCollection();
    }
    
     public function __toString(): string
    {
        return $this->user ?? '';
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getActivityType(): ?string
    {
        return $this->activityType;
    }

    public function setActivityType(?string $activityType): static
    {
        $this->activityType = $activityType;

        return $this;
    }

    public function getServiceOffered(): ?string
    {
        return $this->serviceOffered;
    }

    public function setServiceOffered(?string $serviceOffered): static
    {
        $this->serviceOffered = $serviceOffered;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CustomerRequest>
     */
    public function getCustomerRequests(): Collection
    {
        return $this->customerRequests;
    }

    public function addCustomerRequest(CustomerRequest $customerRequest): static
    {
        if (!$this->customerRequests->contains($customerRequest)) {
            $this->customerRequests->add($customerRequest);
            $customerRequest->setProvider($this);
        }

        return $this;
    }

    public function removeCustomerRequest(CustomerRequest $customerRequest): static
    {
        if ($this->customerRequests->removeElement($customerRequest)) {
            // set the owning side to null (unless already changed)
            if ($customerRequest->getProvider() === $this) {
                $customerRequest->setProvider(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResponseProvider>
     */
    public function getResponseProviders(): Collection
    {
        return $this->responseProviders;
    }

    public function addResponseProvider(ResponseProvider $responseProvider): static
    {
        if (!$this->responseProviders->contains($responseProvider)) {
            $this->responseProviders->add($responseProvider);
            $responseProvider->setProvider($this);
        }

        return $this;
    }

    public function removeResponseProvider(ResponseProvider $responseProvider): static
    {
        if ($this->responseProviders->removeElement($responseProvider)) {
            // set the owning side to null (unless already changed)
            if ($responseProvider->getProvider() === $this) {
                $responseProvider->setProvider(null);
            }
        }

        return $this;
    }

  
}
