<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\Shop;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderHelper
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var string
     */
    private $productImageDirectory;

    public function __construct(SluggerInterface $slugger, string $productImageDirectory)
    {
        $this->slugger = $slugger;
        $this->productImageDirectory = $productImageDirectory;
    }
    
    public function uploadProductImage(Product $product, ?UploadedFile $uploadedFile)
    {
        // Si l'administrateur a rempli le champ image...
        if ($uploadedFile) {

            // Normalisation du nom du fichier image
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(),
                PATHINFO_FILENAME);
            $newFilename = $this->slugger->slug($originalFilename) . '-' . uniqid() . '.'
                . $uploadedFile->guessExtension();

            $product->setProductPicture($newFilename);

            // Copie du fichier temporaire vers le répertoire de destination
            $uploadedFile->move($this->productImageDirectory, $newFilename);
        }

    }

    public function uploadShopImage(Shop $shop, ?UploadedFile $uploadedFile)
    {
        // Si l'administrateur a rempli le champ image...
        if ($uploadedFile) {

            // Suppression de l'image actuelle le cas échéant
            //$this->removePostImageFile($product);

            // Normalisation du nom du fichier image
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(),
                PATHINFO_FILENAME);
            $newFilename = $this->slugger->slug($originalFilename) . '-' . uniqid() . '.'
                . $uploadedFile->guessExtension();

            $shop->setShopPicture($newFilename);

            // Copie du fichier temporaire vers le répertoire de destination
            $uploadedFile->move($this->productImageDirectory, $newFilename);
        }

    }
}