<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function dashboard(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $articles = $entityManager->getRepository(Article::class)->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/admin/delete-article/{id}', name: 'admin_delete_article', methods: ['POST'])]
    public function deleteArticle(
        Article $article,
        EntityManagerInterface $entityManager,
        Request $request,
        CsrfTokenManagerInterface $csrfTokenManager
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $submittedToken = $request->request->get('_token');

        if (!$csrfTokenManager->isTokenValid(new CsrfToken('delete' . $article->getId(), $submittedToken))) {
            throw $this->createAccessDeniedException('Action non autorisée : CSRF token invalide.');
        }

        $entityManager->remove($article);
        $entityManager->flush();

        $this->addFlash('success', 'L\'article a été supprimé avec succès.');

        return $this->redirectToRoute('admin_dashboard');
    }
}
