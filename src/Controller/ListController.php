<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route ("/list", name="list")
     * @return Response
     */
    public function index(): Response
    {

        return $this->render('list/index.html.twig', [
            'lorem_ipsum' => 'Lorem ipsum',
        ]);
    }
}
