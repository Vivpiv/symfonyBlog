<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 15/11/18
 * Time: 15:42
 */

namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     * @return Response
     */
    public function category (Request $request) : Response
    {
        $articles=$this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        
        if(!$articles) {
            throw $this->createNotFoundException('No articles found in article\'s table');
        }
        
        $article = new Article();
        $form = $this->createForm(
            ArticleType::class,
            $article
        );
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            
            return $this->redirectToRoute('article');
        }
        
        return $this->render('article.html.twig', ['articles' => $articles, 'form' => $form->createView(), ]);
    }
}