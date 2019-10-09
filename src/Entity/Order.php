<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Invoice", inversedBy="Invoice_ID")
     */
    private $Invoice_ID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="Product_ID")
     */
    private $Product_ID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quantity;

    public function __construct()
    {
        $this->Product_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceID(): ?Invoice
    {
        return $this->Invoice_ID;
    }

    public function setInvoiceID(?Invoice $Invoice_ID): self
    {
        $this->Invoice_ID = $Invoice_ID;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductID(): Collection
    {
        return $this->Product_ID;
    }

    public function addProductID(Product $productID): self
    {
        if (!$this->Product_ID->contains($productID)) {
            $this->Product_ID[] = $productID;
            $productID->setProductID($this);
        }

        return $this;
    }

    public function removeProductID(Product $productID): self
    {
        if ($this->Product_ID->contains($productID)) {
            $this->Product_ID->removeElement($productID);
            // set the owning side to null (unless already changed)
            if ($productID->getProductID() === $this) {
                $productID->setProductID(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(?int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}
