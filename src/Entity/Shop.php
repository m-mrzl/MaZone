<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
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
    private $shopName;

    /**
     * @ORM\Column(type="text")
     */
    private $shopDescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shopPicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shopPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shopAddress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShopName(): ?string
    {
        return $this->shopName;
    }

    public function setShopName(string $shopName): self
    {
        $this->shopName = $shopName;

        return $this;
    }

    public function getShopDescription(): ?string
    {
        return $this->shopDescription;
    }

    public function setShopDescription(string $shopDescription): self
    {
        $this->shopDescription = $shopDescription;

        return $this;
    }

    public function getShopPicture(): ?string
    {
        return $this->shopPicture;
    }

    public function setShopPicture(string $shopPicture): self
    {
        $this->shopPicture = $shopPicture;

        return $this;
    }

    public function getShopPhone(): ?string
    {
        return $this->shopPhone;
    }

    public function setShopPhone(string $shopPhone): self
    {
        $this->shopPhone = $shopPhone;

        return $this;
    }

    public function getShopAddress(): ?string
    {
        return $this->shopAddress;
    }

    public function setShopAddress(string $shopAddress): self
    {
        $this->shopAddress = $shopAddress;

        return $this;
    }
}
