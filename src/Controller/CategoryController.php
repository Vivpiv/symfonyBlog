<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 12/11/18
 * Time: 10:49
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}