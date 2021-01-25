<?php

namespace App\Factory;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Product|Proxy createOne(array $attributes = [])
 * @method static Product[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Product|Proxy findOrCreate(array $attributes)
 * @method static Product|Proxy random(array $attributes = [])
 * @method static Product|Proxy randomOrCreate(array $attributes = [])
 * @method static Product[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Product[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductRepository|RepositoryProxy repository()
 * @method Product|Proxy create($attributes = [])
 */
final class ProductFactory extends ModelFactory
{
    /**
     * @var SluggerInterface
     */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        parent::__construct();

        $this->slugger = $slugger;
    }

    protected function getDefaults(): array
    {
        return [
            // Création des fakers
            'productName' => self::faker()->text($maxNbChars = 50),
            'productDescription' => self::faker()->text($maxNbChars = 1000),
            'productPicture' => 'https://picsum.photos/seed/post-' . rand(0,500) . '/750/300',
            'price' => self::faker()->randomFloat(2, 0, 500),
            'stock' => self::faker()->randomDigit,
            'createdAt' => self::faker()->dateTimeBetween('-3 years', 'now', 'Europe/Paris'),
            'category' => CategoryFactory::random(),
            'shop' => ShopFactory::random(),
            'province' => ProvinceFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(Product $product) {
                // On récupère le titre de l'article
                $title = $product->getProductName();

                // On sluggifie ce titre avec le slugger
                $slug = $this->slugger->slug($title);

                // On enregistre ce slug dans le champ slug
                $product->setSlug($slug);
            });
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
