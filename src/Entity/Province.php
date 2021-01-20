<?php

namespace App\Entity;

use App\Repository\ProvinceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProvinceRepository::class)
 */
class Province
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
    private $provinceName;

    /**
     * @ORM\OneToMany(targetEntity=Shop::class, mappedBy="province")
     */
    private $shops;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="province")
     */
    private $products;

    public function __construct()
    {
        $this->shops = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    public function setProvinceName(string $provinceName): self
    {
        $this->provinceName = $provinceName;

        return $this;
    }

    /**
     * @return Collection|Shop[]
     */
    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function addShop(Shop $shop): self
    {
        if (!$this->shops->contains($shop)) {
            $this->shops[] = $shop;
            $shop->setProvince($this);
        }

        return $this;
    }

    public function removeShop(Shop $shop): self
    {
        if ($this->shops->removeElement($shop)) {
            // set the owning side to null (unless already changed)
            if ($shop->getProvince() === $this) {
                $shop->setProvince(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setProvince($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProvince() === $this) {
                $product->setProvince(null);
            }
        }

        return $this;
    }
}
