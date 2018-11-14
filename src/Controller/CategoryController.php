<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 12/11/18
 * Time: 10:49
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    /**
     * @param Category $category
     * @return Response
     * @Route("/category/{id}", name="category_show")
     */
    public function show (Category $category): Response
    {
        return $this->render('category.html.twig', ['category' => $category,]);
    }
    
    /**
     * @Route("/categories/articles", name="categoriesArticles_show")
     * @return Response
     */
    public function index (): Response
    {
        $categories=$this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();
        
        if(!$categories) {
            throw $this->createNotFoundException('No categorie found in categorie\'s table');
        }
        
        return $this->render('categoryArticles.html.twig', ['categories' => $categories ]);
    }
    
    /**
     * @Route("/category", name="category_create")
     * @return Response
     */
    public function category (Request $request)
    {
        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
    
        if(!$categories) {
            throw $this->createNotFoundException('No categorie found in categorie\'s table');
        }
    
        $category = new Category();
        $formCategory = $this->createForm(
            CategoryType::class,
            $category
        );
    
        $formCategory->handleRequest($request);
        if ($formCategory->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            header('Location:/category');
        }
    
        return $this->render('categoryCreate.html.twig', ['categories' => $categories, 'formCategory' => $formCategory->createView(), ]);
    }
}