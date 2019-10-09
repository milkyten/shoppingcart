<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user_ID")
     */
    private $user_ID;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Order_placed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Paid;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Paid_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="Invoice_ID")
     */
    private $Invoice_ID;

    public function __construct()
    {
        $this->Invoice_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?User
    {
        return $this->user_ID;
    }

    public function setUserID(?User $user_ID): self
    {
        $this->user_ID = $user_ID;

        return $this;
    }

    public function getOrderPlaced(): ?\DateTimeInterface
    {
        return $this->Order_placed;
    }

    public function setOrderPlaced(?\DateTimeInterface $Order_placed): self
    {
        $this->Order_placed = $Order_placed;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->Paid;
    }

    public function setPaid(?bool $Paid): self
    {
        $this->Paid = $Paid;

        return $this;
    }

    public function getPaidDate(): ?\DateTimeInterface
    {
        return $this->Paid_date;
    }

    public function setPaidDate(?\DateTimeInterface $Paid_date): self
    {
        $this->Paid_date = $Paid_date;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getInvoiceID(): Collection
    {
        return $this->Invoice_ID;
    }

    public function addInvoiceID(Order $invoiceID): self
    {
        if (!$this->Invoice_ID->contains($invoiceID)) {
            $this->Invoice_ID[] = $invoiceID;
            $invoiceID->setInvoiceID($this);
        }

        return $this;
    }

    public function removeInvoiceID(Order $invoiceID): self
    {
        if ($this->Invoice_ID->contains($invoiceID)) {
            $this->Invoice_ID->removeElement($invoiceID);
            // set the owning side to null (unless already changed)
            if ($invoiceID->getInvoiceID() === $this) {
                $invoiceID->setInvoiceID(null);
            }
        }

        return $this;
    }
}
