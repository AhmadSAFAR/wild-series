<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use App\Service\Slugify;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $slugify = new Slugify();

        for ($i = 1; $i <= 1000; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $this->addReference("category_".$i, $category);}
            $manager->flush();


        for ($i = 1; $i <= 1000; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(4, true));
            $program->setSummery($faker->text(100));
            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);
            $program->setCategory($this->getReference("category_".rand(139,1000)));
            $this->addReference('program_'.$i,$program);
            $manager->persist($program);
        }

        $manager->flush();
        for ($i = 1; $i <= 1000; $i++) {
       

            $actor = new Actor();
            $actor->setName($faker->firstName);
            $slug = $slugify->generate($actor->getName());
            $actor->setSlug($slug);
            $this->addReference('actor_' . $i, $actor);
            $actor->addProgram($this->getReference('program_'.rand(5,1000)));
            $manager->persist($actor);
          
        }

        $manager->flush();

    }

   
}