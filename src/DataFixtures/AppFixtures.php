<?php

namespace App\DataFixtures;

use App\Entity\Activityarea;
use App\Entity\Resources;
use App\Entity\Roles;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Utilisation de Faker pour générer des données aléatoires
        $faker = Faker::create('fr_FR');
        $roles = [];

        // Création et persistances des rôles
        foreach (['ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_MENTOR'] as $value) {
            $oneRole = new Roles();
            $oneRole->setRoleName($value);
            $manager->persist($oneRole);
            $roles[] = $oneRole;
        }
        // Génération et persistance de 10 utilisateurs
        $users = [];
        for ($i = 0; $i < 10; ++$i) {
            $user = new Users();
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setBirthdate($faker->dateTime());
            $user->setAddress($faker->address());
            $user->setRole($faker->randomElement($roles));
            $manager->persist($user);
            $users[] = $user;
        }

        // Création et persistance de 3 domaines d'activités
        $activitysArea = [];
        foreach (['INFORMATIQUE', 'SPORT', 'MEDECINE'] as $value) {
            $activityArea = new Activityarea();
            $activityArea->setActivityAreaName($value);
            $manager->persist($activityArea);
            $activitysArea[] = $activityArea;
        }

        // Génération et persistance de 5 mentors
        $mentors = [];
        for ($i = 0; $i < 5; ++$i) {
            $mentor = new Users();
            $mentor->setFirstName($faker->firstName());
            $mentor->setLastName($faker->lastName());
            $mentor->setEmail($faker->email());
            $mentor->setPassword($faker->password());
            $mentor->setBirthdate($faker->dateTime());
            $mentor->setAddress($faker->address());
            $mentor->setRole($roles[2]); // ROLE_MENTOR
            $mentor->addMentor($faker->randomElement($users));
            $manager->persist($mentor);
            $mentors[] = $mentor;
        }

        // Génération de ressources
        $resource = [];
        for ($i = 0; $i <= 10; ++$i) {
            $resource = new Resources();
            $resource->setTitle('Title'.$i)
                ->setDescription('Description'.$i)
                ->setAuthor('Author'.$i)
                ->setType('Type'.$i);

            $manager->persist($resource);
        }

        // Vous pouvez vous baser sur ces exemples pour générer les données pour les autres entités
        // En utilisant les méthodes de génération de données fournies par Faker
        // et en respectant la logique de votre modèle de données et de vos relations entre entités.

        $manager->flush();
    }
}
