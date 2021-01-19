<?php

namespace App\Factory;

use App\Entity\Shop;
use App\Repository\ShopRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Shop|Proxy createOne(array $attributes = [])
 * @method static Shop[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Shop|Proxy findOrCreate(array $attributes)
 * @method static Shop|Proxy random(array $attributes = [])
 * @method static Shop|Proxy randomOrCreate(array $attributes = [])
 * @method static Shop[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Shop[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShopRepository|RepositoryProxy repository()
 * @method Shop|Proxy create($attributes = [])
 */
final class ShopFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'shopName' => self::faker()->company(),
            'shopDescription' => self::faker()->text($maxNbChars = 1000),
            'shopPicture' => 'https://picsum.photos/seed/post-' . rand(0,500) . '/750/300',
            'shopPhone' => self::faker()->phoneNumber(),
            'shopAddress' => self::faker()->streetAddress(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Shop $shop) {})
        ;
    }

    protected static function getClass(): string
    {
        return Shop::class;
    }
}
