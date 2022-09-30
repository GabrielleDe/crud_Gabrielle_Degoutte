<?php

namespace App\DataFixtures;

use App\Entity\Employes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <=5; $i++)
        {
            $employes = new Employes;

            $employes->setPrenom("Prenom $i")
                     ->setNom("Nom $i") 
                     ->setTelephone("Tel $i")
                     ->setEmail("Email $i")
                     ->setAdresse("Adresse $i")
                     ->setPoste("Dev")
                     ->setSalaire(1300)
                     ->setDatedenaissance(new \DateTime("10/21/1993"));

            $manager->persist($employes);

        }

        $manager->flush($employes);
    }
}
