<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $order_id;

    /**
     * @ORM\Column(type="float")
     */
    private $order_total;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $order_discount;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_items_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $shipping_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $order_status;

    /**
     * @ORM\Column(type="integer")
     */
    private $customer_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    public function setOrderId(string $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getOrderTotal(): ?float
    {
        return $this->order_total;
    }

    public function setOrderTotal(float $order_total): self
    {
        $this->order_total = $order_total;

        return $this;
    }

    public function getOrderDiscount(): ?float
    {
        return $this->order_discount;
    }

    public function setOrderDiscount(?float $order_discount): self
    {
        $this->order_discount = $order_discount;

        return $this;
    }

    public function getOrderItemsId(): ?int
    {
        return $this->order_items_id;
    }

    public function setOrderItemsId(int $order_items_id): self
    {
        $this->order_items_id = $order_items_id;

        return $this;
    }

    public function getShippingId(): ?int
    {
        return $this->shipping_id;
    }

    public function setShippingId(int $shipping_id): self
    {
        $this->shipping_id = $shipping_id;

        return $this;
    }

    public function getOrderStatus(): ?string
    {
        return $this->order_status;
    }

    public function setOrderStatus(string $order_status): self
    {
        $this->order_status = $order_status;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }
}
