<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface{
    
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
    
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $article = new Article();
            $faker  =  Faker\Factory::create('fr_FR');
            $article->setTitle(mb_strtolower($faker->sentence()));
    
            $content='';
            foreach ($faker->sentences() as $value) {
                $content.=$value.' ';
            }
            $article->setContent(mb_strtolower($content));
            $article->setCategory($this->getReference('categorie_'.rand(0,4)));
            $manager->persist($article);
        }
        
        $manager->flush();
    }
}
