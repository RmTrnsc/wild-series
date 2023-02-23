<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        'The Last Of Us' => [
            'category' => 'Action',
            'synopsis' => "Vingt ans après la destruction de la civilisation moderne, Joel, un survivant endurci, est engagé pour faire sortir Ellie, une jeune fille de 14 ans, d'une zone de quarantaine oppressante. Ce qui n'est au départ qu'un petit travail se transforme rapidement en un voyage brutal et époustouflant, alors que ce duo improbable dépend de l'autre pour sa survie."
        ],
        'You' => [
            'category' => 'Drame',
            'synopsis' => "Le gestionnaire intelligent d'une librairie compte sur ses connaissances informatique pour que la femme de ses rêves tombe amoureuse de lui."
        ],
        'Poker Face' => [
            'category' => 'Drame',
            'synopsis' => "Charlie a une capacité extraordinaire à déterminer quand quelqu'un ment. Elle prend la route avec sa Plymouth Barracuda et à chaque arrêt, elle rencontre de nouveaux personnages et des crimes qu'elle ne peut s'empêcher de résoudre."
        ],
        'The Walking Dead' => [
            'category' => 'Horreur',
            'synopsis' => "Lorsque le shérif adjoint Rick Grimes sort du coma et apprend que le monde est en ruine, il doit aider un groupe de survivants à rester en vie."
        ],
        'Mercredi' => [
            'category' => 'Fantastique',
            'synopsis' => "Suit les années d'études de Mercredi Addams, alors qu'elle tente de maîtriser ses nouvelles capacités psychiques, de déjouer et de résoudre le mystère qui a impliqué ses parents"
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $item) {
            $program = new Program();
            $program->setTitle($key);
            $program->setSynopsis($item['synopsis']);
            $program->setCategory($this->getReference('category_' . $item['category']));
            $manager->persist($program);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
