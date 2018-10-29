<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 29/10/18
 * Time: 16:06
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }
}