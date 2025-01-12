<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('ROLE_BANNED')) {
            return $this->render('banned.html.twig', [
                'message' => 'Votre compte a été banni. Veuillez contacter un administrateur.',
            ]);
        }

        $categories = $entityManager->getRepository(Category::class)->findAll();
        $articles = $entityManager->getRepository(Article::class)->findAll();
        $comments = $entityManager->getRepository(Comment::class)->findAll();

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'articles' => $articles,
            'comments' => $comments,
        ]);
    }

    #[Route('/categories/{id}', name: 'app_category_articles')]
    public function showCategory(Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('ROLE_BANNED')) {
            return $this->render('banned.html.twig', [
                'message' => 'Votre compte a été banni. Veuillez contacter un administrateur.',
            ]);
        }

        $articles = $entityManager->getRepository(Article::class)->findBy(['category' => $category]);

        return $this->render('home/category.html.twig', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/{id}', name: 'app_article_details')]
    public function showArticle(Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isGranted('ROLE_BANNED')) {
            return $this->render('banned.html.twig', [
                'message' => 'Votre compte a été banni. Veuillez contacter un administrateur.',
            ]);
        }

        $comments = $entityManager->getRepository(Comment::class)->findBy(['article' => $article]);

        return $this->render('home/article.html.twig', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }
}
