<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i <= 10; $i++) {
            $product = new Product();
            $product->setLib("lib $i")
                ->setPu($i * 10 + 5)
                ->setDscr("description de l'article n° $i")
                ->setImg("http://placehold.it/350*150");
            $manager->persist($product);
        }
        $manager->flush();
    }
}
