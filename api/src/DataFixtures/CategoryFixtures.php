<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ['Fruits','Légumes'];
        foreach ($names as $name){
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
