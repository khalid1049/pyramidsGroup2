<?php

namespace App\Entity;

use App\Repository\StandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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
    private ?string $type = null;

    #[ORM\Column (nullable: true)]
    private ?bool $status = null;

    #[ORM\ManyToOne(inversedBy: 'stands')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Exhibitor $exhibitor = null;

    #[ORM\Column(nullable: true)]
    private ?string $price = null;

    /**
     * @var Collection<int, CustomerRequest>
     */
    #[ORM\OneToMany(targetEntity: CustomerRequest::class, mappedBy: 'stand', orphanRemoval: true)]
    private Collection $customerRequests;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $size = null;

    #[ORM\Column(nullable: true)]
    private ?int $open_side = null;

    #[ORM\OneToOne(mappedBy: 'stand', cascade: ['persist', 'remove'])]
    private ?ResponseProvider $responseProvider = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $extra = null;

    #[ORM\Column(nullable: true)]
    private ?int $chair = null;

    #[ORM\Column(nullable: true)]
    private ?int $tableStand = null;

    #[ORM\Column(nullable: true)]
    private ?int $spot = null;

    #[ORM\Column(nullable: true)]
    private ?int $rod = null;

    #[ORM\Column(nullable: true)]
    private ?int $shelf = null;

    #[ORM\Column(nullable: true)]
    private ?int $tribleSocket = null;

    

    public function __construct()
    {   
        // $this->exhibitor = new Exhibitor();
        // $this->number = $this->generateStandNumber();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
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

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getOpenSide(): ?int
    {
        return $this->open_side;
    }

    public function setOpenSide(?int $open_side): static
    {
        $this->open_side = $open_side;

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
            $this->responseProvider->setStand(null);
        }

        // set the owning side of the relation if necessary
        if ($responseProvider !== null && $responseProvider->getStand() !== $this) {
            $responseProvider->setStand($this);
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
}