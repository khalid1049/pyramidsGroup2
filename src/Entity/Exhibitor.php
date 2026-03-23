<?php

namespace App\Entity;

use App\Repository\ExhibitorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExhibitorRepository::class)]
class Exhibitor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $CompanyName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $sectorActivity = null;

    #[ORM\Column(length: 255)]
    private ?string $productDisplay = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToOne(mappedBy: 'exhibitor', cascade: ['persist', 'remove'])]
    private ?Invoice $invoice = null;



    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

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
    private ?string $facia_name = null;

    public function __construct()
    {   
        // $this->user = new User();
        // $this->stand = new Stand();
        $this->stands = new ArrayCollection();
        $this->customerRequests = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->CompanyName ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    public function setCompanyName(string $CompanyName): static
    {
        $this->CompanyName = $CompanyName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getSectorActivity(): ?string
    {
        return $this->sectorActivity;
    }

    public function setSectorActivity(string $sectorActivity): static
    {
        $this->sectorActivity = $sectorActivity;

        return $this;
    }

    public function getProductDisplay(): ?string
    {
        return $this->productDisplay;
    }

    public function setProductDisplay(string $productDisplay): static
    {
        $this->productDisplay = $productDisplay;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
        // set the owning side of the relation if necessary
        if ($invoice->getExhibitor() !== $this) {
            $invoice->setExhibitor($this);
        }

        $this->invoice = $invoice;

        return $this;
    }

    

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
            if ($customerRequest->getExhibitor() === $this) {
                $customerRequest->setExhibitor(null);
            }
        }

        return $this;
    }

    public function getFaciaName(): ?string
    {
        return $this->facia_name;
    }

    public function setFaciaName(?string $facia_name): static
    {
        $this->facia_name = $facia_name;

        return $this;
    }
}
