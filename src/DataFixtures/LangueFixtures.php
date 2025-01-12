<?php

namespace App\DataFixtures;

use App\Entity\Langue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LangueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $langues = [
            ['nom' => 'Français', 'code' => 'fr', 'estActive' => true],
            ['nom' => 'Anglais', 'code' => 'en', 'estActive' => true],
            ['nom' => 'Espagnol', 'code' => 'es', 'estActive' => false],
        ];

        foreach ($langues as $data) {
            $langue = new Langue();
            $langue->setNom($data['nom'])
                   ->setCode($data['code'])
                   ->setEstActive($data['estActive']);
            $manager->persist($langue);
        }

        $manager->flush();
    }
}
