<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 08/11/18
 * Time: 13:33
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/{slug}", requirements={"slug"="[a-z0-9-]+"}, name="blog_slug")
     */
    public function show($slug="article-sans-titre") {
        
        $slug=ucwords(str_replace("-"," ",$slug));
        
        return $this->render('blog.html.twig', ['slug' => $slug,]);
    }
}