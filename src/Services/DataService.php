<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\LogsRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class DataService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var LogsRepository
     */
    private $logsRepository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository, LogsRepository $logsRepository)
    {
        $this->repository = $repository;
        $this->logsRepository = $logsRepository;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setStatChangeAction(Request $request): void
    {
        $user_id = $request->get('user_id');
        $type = $request->get('type');
        $value = $request->get('value');

        if ( $type == "access" ) $this->repository->setAccess($user_id, $value);
            else if ( $type == "status" ) $this->repository->setStatus($user_id, $value);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUserDetailsData(Request $request): array
    {
        $user_id = $request->get('user_id');
        return array(   'user' => $this->repository->getUser($user_id),
                        'logs' => $this->logsRepository->getLogs($user_id)
                    );
    }



}