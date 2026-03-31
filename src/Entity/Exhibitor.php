<?php

namespace App\Entity;

use App\Repository\ExhibitorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExhibitorRepository::class)]
class Exhibitor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $companyName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sectorActivity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productDisplay = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\OneToOne(mappedBy: 'exhibitor', cascade: ['persist', 'remove'])]
    private ?Invoice $invoice = null;

  
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faciaName = null;

    /**
     * @var Collection<int, Stand>
     */
    #[ORM\OneToMany(targetEntity: Stand::class, mappedBy: 'exhibitor', orphanRemoval: true)]
    private Collection $stands;

    /**
     * @var Collection<int, CustomerRequest>
     */
    #[ORM\OneToMany(targetEntity: CustomerRequest::class, mappedBy: 'exhibitor', orphanRemoval: true)]
    private Collection $customerRequests;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productGroup = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\OneToOne(mappedBy: 'exhibitor', cascade: ['persist', 'remove'])]
    private ?ResponseProvider $responseProvider = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sales = null;

    public function __construct()
    {
        $this->stands = new ArrayCollection();
        $this->customerRequests = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->companyName ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): static
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;
        return $this;
    }

    public function getSectorActivity(): ?string
    {
        return $this->sectorActivity;
    }

    public function setSectorActivity(?string $sectorActivity): static
    {
        $this->sectorActivity = $sectorActivity;
        return $this;
    }

    public function getProductDisplay(): ?string
    {
        return $this->productDisplay;
    }

    public function setProductDisplay(?string $productDisplay): static
    {
        $this->productDisplay = $productDisplay;
        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): static
    {
        if ($invoice->getExhibitor() !== $this) {
            $invoice->setExhibitor($this);
        }

        $this->invoice = $invoice;
        return $this;
    }

  

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    public function getFaciaName(): ?string
    {
        return $this->faciaName;
    }

    public function setFaciaName(?string $faciaName): static
    {
        $this->faciaName = $faciaName;
        return $this;
    }

    /**
     * @return Collection<int, Stand>
     */
    public function getStands(): Collection
    {
        return $this->stands;
    }

    public function addStand(Stand $stand): static
    {
        if (!$this->stands->contains($stand)) {
            $this->stands->add($stand);
            $stand->setExhibitor($this);
        }

        return $this;
    }

    public function removeStand(Stand $stand): static
    {
        if ($this->stands->removeElement($stand)) {
            if ($stand->getExhibitor() === $this) {
                $stand->setExhibitor(null);
            }
        }

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
            $customerRequest->setExhibitor($this);
        }

        return $this;
    }

    public function removeCustomerRequest(CustomerRequest $customerRequest): static
    {
        if ($this->customerRequests->removeElement($customerRequest)) {
            if ($customerRequest->getExhibitor() === $this) {
                $customerRequest->setExhibitor(null);
            }
        }

        return $this;
    }

    public function getProductGroup(): ?string
    {
        return $this->productGroup;
    }

    public function setProductGroup(?string $productGroup): static
    {
        $this->productGroup = $productGroup;

        return $this;
    }

    
    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

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
            $this->responseProvider->setExhibitor(null);
        }

        // set the owning side of the relation if necessary
        if ($responseProvider !== null && $responseProvider->getExhibitor() !== $this) {
            $responseProvider->setExhibitor($this);
        }

        $this->responseProvider = $responseProvider;

        return $this;
    }

    public function getSales(): ?string
    {
        return $this->sales;
    }

    public function setSales(?string $sales): static
    {
        $this->sales = $sales;

        return $this;
    }
}