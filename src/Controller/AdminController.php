<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route ("/admin/list", name="admin_list")
     * @return Response
     */
//    #[Route('/admin/list', name: 'admin_list')]
    public function index(): Response
    {
        $users = $this->repository->all();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }
}
