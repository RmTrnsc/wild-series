<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture
{

    private \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 25; $i++) {
            $episode = new Episode();
            $episode->setTitle($this->faker->text(85));
            $episode->setSynopsis($this->faker->realText($maxNbChars = 200, $indexSize = 2));
            $episode->setNumber($this->faker->numberBetween(1, 30));
            $manager->persist($episode);
        }

        $manager->flush();
    }
}
