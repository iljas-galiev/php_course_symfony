<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/blog', name: 'blog_list')]
    public function world()
    {
        return $this->render('hello.twig', ['foo' => new class { public $abc = 'bar1';}]);
    }
}