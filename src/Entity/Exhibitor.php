<?php

namespace App\Entity;

use App\Repository\ExhibitorRepository;
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

    #[ORM\OneToOne(inversedBy: 'exhibitor', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'exhibitor', cascade: ['persist', 'remove'])]
    private ?Invoice $invoice = null;

    #[ORM\OneToOne(mappedBy: 'exhibitor', cascade: ['persist', 'remove'])]
    private ?Stand $stand = null;

    public function __construct()
    {   
        $this->user = new User();
        $this->stand = new Stand();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

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

    public function getStand(): ?Stand
    {
        return $this->stand;
    }

    public function setStand(Stand $stand): static
    {
        // set the owning side of the relation if necessary
        if ($stand->getExhibitor() !== $this) {
            $stand->setExhibitor($this);
        }

        $this->stand = $stand;

        return $this;
    }
}
