<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Style;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $artists = [];
        $users = [];


        $user1 = new User();
        $user1->setEmail('test@test.com')
            ->setPassword($this->encoder->encodePassword($user1, '1234'));

        $users[] = $user1;

        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('test2@test2.com')
            ->setPassword($this->encoder->encodePassword($user2, '1234'));

        $users[] = $user2;
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('test3@test3.com')
            ->setPassword($this->encoder->encodePassword($user3, '1234'));

        $users[] = $user3;
        $manager->persist($user3);

        $admin = new User();
        $admin->setEmail('admin@admin.admin')
            ->setPassword($this->encoder->encodePassword($user3, '1234'))
            ->setRoles(['ROLE_ADMIN']);

        $users[] = $admin;
        $manager->persist($admin);

        for ($i = 0; $i < 20; $i++) {
            $artist = new Artist();

            $artist->setName($faker->firstName())
                ->setStartYear($faker->year())
                ->addUser($users[$faker->numberBetween(0, count($users) - 1)])
                ->addUser($users[$faker->numberBetween(0, count($users) - 1)]);


            $manager->persist($artist);
            $artists[] = $artist;
        }

        for ($i = 0; $i < 20; $i++) {
            $style = new Style();

            $style->setName($faker->word())
                ->addArtist($artists[$faker->numberBetween(0, count($artists) - 1)])
                ->addArtist($artists[$faker->numberBetween(0, count($artists) - 1)]);

            $manager->persist($style);
        }


        $album = new Album();
        for ($j = 0; $j < 40; $j++) {

            $album = new Album();
            $album->setName($faker->words(2, true))
                ->setReleaseYear($faker->year())
                ->setArtist($artists[$faker->numberBetween(0, count($artists) - 1)]);

            $manager->persist($album);
        }

        $manager->flush();
    }
}
