<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numInvoice = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(inversedBy: 'invoice', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exhibitor $exhibitor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumInvoice(): ?string
    {
        return $this->numInvoice;
    }

    public function setNumInvoice(string $numInvoice): static
    {
        $this->numInvoice = $numInvoice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getExhibitor(): ?Exhibitor
    {
        return $this->exhibitor;
    }

    public function setExhibitor(Exhibitor $exhibitor): static
    {
        $this->exhibitor = $exhibitor;

        return $this;
    }
}
