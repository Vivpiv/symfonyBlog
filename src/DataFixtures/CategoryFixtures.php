<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private $categories = [
        'PHP',
        'Javascript',
        'Java',
        'Ruby',
        'Python',
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach ($this->categories as $key => $value) {
            $category = new Category();
            $category->setName($value);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);
        }
        $manager->flush();
    }
}
