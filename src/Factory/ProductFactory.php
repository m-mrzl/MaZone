<?php

namespace App\Factory;

use App\Entity\Product;
use App\Repository\ProductRepository;
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
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'productName' => self::faker()->text($maxNbChars = 50),
            'productDescription' => self::faker()->text($maxNbChars = 1000),
            'productPicture' => 'https://picsum.photos/seed/post-' . rand(0,500) . '/750/300',
            'price' => self::faker()->randomFloat(2, 0, 500),
            'stock' => self::faker()->randomDigit,
            'createdAt' => self::faker()->dateTimeBetween('-3 years', 'now', 'Europe/Paris'),
            'category' => CategoryFactory::random(),
            'shop' => ShopFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Product $product) {})
        ;
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
