<?php

namespace App\DataFixtures;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Personne;
use Faker;
class PersonneFixture extends AppFixtures
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
for ($i=0; $i < 100; $i++) {
    $personne = new Personne();
        $personne->setFirstname($faker->firstName);
        $personne->setName($faker->name);
        $personne->setAge($faker->numberBetween(16,65));
        
$manager->persist($personne);
}

        $manager->flush();
    }
}
