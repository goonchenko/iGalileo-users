<?php

namespace App\Controller;

use App\Services\DataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
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
     * @Route ("/admin/post", name="admin_post", methods={"GET", "POST"})
     * @param Request $request
     * @return void
     */
    public function getStatChange(Request $request): void
    {
        $this->dataService->setStatChangeAction($request);
    }
}
