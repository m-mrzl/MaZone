<?php

namespace App\Factory;

use App\Entity\Province;
use App\Repository\ProvinceRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Province|Proxy createOne(array $attributes = [])
 * @method static Province[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Province|Proxy findOrCreate(array $attributes)
 * @method static Province|Proxy random(array $attributes = [])
 * @method static Province|Proxy randomOrCreate(array $attributes = [])
 * @method static Province[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Province[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProvinceRepository|RepositoryProxy repository()
 * @method Province|Proxy create($attributes = [])
 */
final class ProvinceFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // Création des fakers
            'provinceName' => self::faker()->city()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Province $province) {})
        ;
    }

    protected static function getClass(): string
    {
        return Province::class;
    }
}
