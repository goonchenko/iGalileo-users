<?php

namespace App\Entity;

use App\Repository\LogsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Table(name="logs")
 * @ORM\Entity(repositoryClass="App\Repository\LogsRepository", repositoryClass=LogsRepository::class)
 */
// @ORM\Entity(repositoryClass="App\Repository\LogsRepository", repositoryClass=LogsRepository::class)
// @ORM\Entity(repositoryClass=LogsRepository::class)
class Logs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="ip", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $ip;


    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->userId = $user->getId();
        $this->date = new \DateTime();
        $this->ip = ip2long($user->getIp());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getIp()
    {
        return $this->ip;
    }
}
