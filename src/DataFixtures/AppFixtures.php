<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $category1 = new Category();
        $category1->setName('Musique');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Sport');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Avenir');
        $manager->persist($category3);

        $categories = [$category1, $category2, $category3];


        $admin = new User();
        $admin->setEmail('admin@example.com')
              ->setPassword(password_hash('adminpassword', PASSWORD_BCRYPT)) 
              ->setFirstName('Admin')
              ->setLastName('User')
              ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@example.com')
             ->setPassword(password_hash('userpassword', PASSWORD_BCRYPT))
             ->setFirstName('Eikichi')
             ->setLastName('Onizuka')
             ->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $banned = new User();
        $banned->setEmail('banned@example.com')
               ->setPassword(password_hash('bannedpassword', PASSWORD_BCRYPT))
               ->setFirstName('Banned')
               ->setLastName('User')
               ->setRoles(['ROLE_BANNED']);
        $manager->persist($banned);


        $article1 = new Article();
        $article1->setTitle('Les tendances musicales du professeur Onizuka')
                 ->setContent('Un article détaillé sur les tendances musicales du professeur Onizuka.')
                 ->setCreatedAt(new \DateTimeImmutable('2025-01-01'))
                 ->setUpdatedAt(new \DateTimeImmutable('2025-01-02'))
                 ->setAuthor($admin)
                 ->setCategory($category1);
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setTitle('Les bienfaits du sport quotidien')
                 ->setContent('Voici pourquoi vous devriez intégrer le sport dans votre quotidien.')
                 ->setCreatedAt(new \DateTimeImmutable('2025-01-03'))
                 ->setUpdatedAt(new \DateTimeImmutable('2025-01-04'))
                 ->setAuthor($user)
                 ->setCategory($category2);
        $manager->persist($article2);

        $article3 = new Article();
        $article3->setTitle('L’avenir du professeur Onizuka')
                 ->setContent('Est-ce une bonne idée de rester prof au Japon.')
                 ->setCreatedAt(new \DateTimeImmutable('2025-01-05'))
                 ->setUpdatedAt(new \DateTimeImmutable('2025-01-06'))
                 ->setAuthor($admin)
                 ->setCategory($category3);
        $manager->persist($article3);


        $comment1 = new Comment();
        $comment1->setContent('Super article sur la musique ! Merci pour ce partage légendaire.')
                 ->setCreatedAt(new \DateTimeImmutable('2025-01-07'))
                 ->setAuthor($user)
                 ->setArticle($article1);
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent('Oui le sport c’est la vie je VALIDE !')
                 ->setCreatedAt(new \DateTimeImmutable('2025-01-08'))
                 ->setAuthor($banned)
                 ->setArticle($article2);
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setContent('Très intéressant et instructif moi qui suis professeur de Français, ça m’intéresserait de savoir si c’est une bonne chose de rester prof au Japon.')
                 ->setCreatedAt(new \DateTimeImmutable('2025-01-09'))
                 ->setAuthor($admin)
                 ->setArticle($article3);
        $manager->persist($comment3);

        $manager->flush();
    }
}
