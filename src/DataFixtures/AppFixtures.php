<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Fonction;
use App\Entity\Groupement;
use App\Entity\Membre;
use App\Entity\Administrateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $now = new \DateTime();
        $createdAt = new \DateTimeImmutable();

        // Rôles
        $roleMembre = (new Role())
            ->setNom('Membre')
            ->setDescription('Membre du groupement')
            ->setCreateAt($createdAt)
            ->setUpdateAt($now);

        $roleAdmin = (new Role())
            ->setNom('Administrateur')
            ->setDescription('Administrateur du groupement')
            ->setCreateAt($createdAt)
            ->setUpdateAt($now);

        $manager->persist($roleMembre);
        $manager->persist($roleAdmin);

        // Fonctions
        $fonctionMembre = (new Fonction())
            ->setNom('Membre actif')
            ->setDescription('Participe aux activités du groupement')
            ->setCreateAt($createdAt)
            ->setUpdateAt($now);

        $fonctionResponsable = (new Fonction())
            ->setNom('Responsable')
            ->setDescription('Responsable des activités')
            ->setCreateAt($createdAt)
            ->setUpdateAt($now);

        $manager->persist($fonctionMembre);
        $manager->persist($fonctionResponsable);

        // Groupement
        $groupement = (new Groupement())
            ->setNom('Solidarité Dakar')
            ->setAdresse('Dakar, Sénégal')
            ->setTel('770000001')
            ->setCreateAt($createdAt)
            ->setUpdateAt($now);

        $manager->persist($groupement);

        // Membre
        $membre = (new Membre())
            ->setLogin('membre1')
            ->setPassword(password_hash('Membre123!', PASSWORD_DEFAULT))
            ->setCreateAt($createdAt)
            ->setUpdateAt($now)
            ->setRole($roleMembre)
            ->setNomComplet('Amadou Diallo')
            ->setTel('770000002')
            ->setAdresse('Pikine, Dakar')
            ->setFonction($fonctionMembre)
            ->setGroupement($groupement);

        $manager->persist($membre);

        // Administrateur
        $admin = (new Administrateur())
            ->setLogin('admin')
            ->setPassword(password_hash('Admin123!', PASSWORD_DEFAULT))
            ->setCreateAt($createdAt)
            ->setUpdateAt($now)
            ->setRole($roleAdmin)
            ->setNomComplet('Aminata Ndiaye')
            ->setTel('770000003')
            ->setAdresse('Plateau, Dakar')
            ->setFonction($fonctionResponsable)
            ->setGroupement($groupement)
            ->setDateNomination($createdAt)
            ->setStatut('actif');

        $manager->persist($admin);

        $manager->flush();
    }
}
