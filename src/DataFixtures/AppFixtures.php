<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ProductFactory;
use App\Factory\ProvinceFactory;
use App\Factory\ShopFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        ProductFactory::new()->createMany(30);
        CategoryFactory::new()->createMany(7);
        ShopFactory::new()->createMany(10);
        ProvinceFactory::new()->createMany(3);

        $manager->flush();
    }
}
