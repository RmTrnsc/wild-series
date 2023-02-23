<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\Repository\ProgramRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture
{

    private \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 9; $i++) {
            $season = new Season();
            $season->setNumber($i);
            $season->setDescription($this->faker->text);
            $season->setYear($this->faker->year);
            $season->setProgram(rand(1, 8));
        }
        // $product = new Product();
        // $manager->persist($product);


        $manager->flush();
    }
}
