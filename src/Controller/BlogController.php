<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 08/11/18
 * Time: 13:33
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/{slug}", requirements={"slug"="[a-z0-9-]+"}, name="blog_show")
     */
    public function show($slug) {
    
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }
    
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
    
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
    
        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }
    
        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }
    
    /**
     * @Route("/", name="blog_index")
     * @return Response
     */
    public function index():Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
    
        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
    
        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }
    
    /**
     * @param string $categoryName
     * @Route("/category/{categoryName}", name="blog_show_category")
     * @return Response
     */
    public function showByCategory(string $categoryName)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(["name" => $categoryName]);
        
        if (!$category) {
            throw $this->createNotFoundException(
                'No category with '.$categoryName.' title, found in category\'s table.'
            );
        }
    
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(["category" => $category->getId()],
                ["id" => "DESC"],
                3
            );
        
        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category, 'articles' => $articles
            ]
        );
    }
    
}