<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $productImageUrl;

    public function __construct($productImageUrl)
    {
        $this->productImageUrl = $productImageUrl;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_product_image', [$this, 'assetProductImage']),
        ];
    }

    public function assetProductImage($image)
    {
        // Si c'est une URL qui est enregistrée (notamment pour les fixtures)
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // Sinon (c'est le nom d'un fichier uploadé)
        return  '/' . $this->productImageUrl . '/' . $image;
    }
}
