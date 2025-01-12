<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $category1 = new Category();
        $category1->setName('Musique')
                  ->setImage('images/gto1.jpg');
        $manager->persist($category1);
        
        $category2 = new Category();
        $category2->setName('Sport')
                  ->setImage('images/gto2.jpg');
        $manager->persist($category2);
        
        $category3 = new Category();
        $category3->setName('Avenir')
                  ->setImage('images/gto5.jpg');
        $manager->persist($category3);
        

        $categories = [$category1, $category2, $category3];


        $admin = new User();
        $admin->setEmail('admin@example.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'JeSuisAdmin'))
            ->setFirstName('AdminBeau')
            ->setLastName('Gosse')
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@example.com')
            ->setPassword($this->passwordHasher->hashPassword($user, 'BonSangDeBonsai'))
            ->setFirstName('Eikichi')
            ->setLastName('Onizuka')
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $banned = new User();
        $banned->setEmail('banned@example.com')
            ->setPassword($this->passwordHasher->hashPassword($banned, 'AuRevoir'))
            ->setFirstName('Le')
            ->setLastName('Banni')
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
