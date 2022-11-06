<?php

namespace App\DataFixtures;

use App\Entity\Band;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;
    private $userEmailAndPassword = 'user@user.com';

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // Users creation
        $user = new User();
        $name = $this->faker->firstName();
        $surname = $this->faker->lastName();
        $pseudo = str_replace(' ', '', $name.ucfirst($surname));
        $user->setAboutMe($this->faker->text())
            ->setEmail($this->userEmailAndPassword)
            ->setName($name)
            ->setPseudo($pseudo)
            ->setSurname($surname)
            ->setTelephone($this->faker->phoneNumber());

        $password = $this->passwordHasher->hashPassword($user, $this->userEmailAndPassword);
        $user->setPassword($password);

        $manager->persist($user);

        // Bands creation
        $nbOfBands = 10;
        for ($i = 0; $i < $nbOfBands; ++$i) {
            $band = new Band();
            $bandName = ucfirst($this->faker->safeColorName()).' '.ucfirst($this->faker->word());
            $band->setName($bandName)
                ->setCreator($user)
                ->setFormedIn($this->faker->year());
            $manager->persist($band);
        }

        $manager->flush();
    }
}
