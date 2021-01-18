<?php

namespace App\Entity;

use App\Repository\ProvinceRepository;
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
}
