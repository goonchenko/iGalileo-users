<?php

namespace App\Controller;

use App\Services\DataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDetailsDataController extends AbstractController
{
    /**
     * @var DataService
     */
    private $dataService;

    /**
     * @param DataService $dataService
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }


    /**
     * @Route ("/admin/user", name="user_details", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $data = $this->dataService->getUserDetailsData($request);
        return $this->render('admin/detailed.html.twig', [
            'user' => $data['user'],
            'logs' => $data['logs']
        ]);
    }


}