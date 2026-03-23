<?php

namespace App\Entity;

use App\Repository\StandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'stands')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exhibitor $exhibitor = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    /**
     * @var Collection<int, CustomerRequest>
     */
    #[ORM\OneToMany(targetEntity: CustomerRequest::class, mappedBy: 'stand', orphanRemoval: true)]
    private Collection $customerRequests;

    

    public function __construct()
    {   
        // $this->exhibitor = new Exhibitor();
        $this->number = $this->generateStandNumber();
        $this->customerRequests = new ArrayCollection();
    }
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

    public function setExhibitor(?Exhibitor $exhibitor): static
    {
        $this->exhibitor = $exhibitor;

        return $this;
    }

    protected function generateStandNumber(): string
    {
        // Générer un numéro de stand unique (par exemple, en utilisant un UUID ou une combinaison de lettres et de chiffres)
        return uniqid('STAND-');
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

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
            $customerRequest->setStand($this);
        }

        return $this;
    }

    public function removeCustomerRequest(CustomerRequest $customerRequest): static
    {
        if ($this->customerRequests->removeElement($customerRequest)) {
            // set the owning side to null (unless already changed)
            if ($customerRequest->getStand() === $this) {
                $customerRequest->setStand(null);
            }
        }

        return $this;
    }
}
