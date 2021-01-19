<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="shop")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=Province::class, inversedBy="shops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $province;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="shop", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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
            $product->setShop($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getShop() === $this) {
                $product->setShop(null);
            }
        }

        return $this;
    }

    public function getProvince(): ?Province
    {
        return $this->province;
    }

    public function setProvince(?Province $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setShop(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getShop() !== $this) {
            $user->setShop($this);
        }

        $this->user = $user;

        return $this;
    }
}
