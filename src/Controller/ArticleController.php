<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'article_show')]
    public function show(Articles $article): Response
    {
        return $this->render('article/show.html.twig', [
            "article" => $article,
        ]);
    }
}
