<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\ProductFactory;
use App\Factory\ProvinceFactory;
use App\Factory\ShopFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::new()->createMany(40);

        CategoryFactory::new()->createMany(7);

        ProvinceFactory::new()->createMany(3);

        ShopFactory::new()->createMany(10);

        ProductFactory::new()->createMany(30);

        CommentFactory::new()->createMany(40);

        $manager->flush();
    }
}
