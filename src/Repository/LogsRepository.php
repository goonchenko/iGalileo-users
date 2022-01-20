<?php

namespace App\Repository;

use App\Entity\Logs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
//use http\Exception\RuntimeException;

/**
 * @method Logs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logs[]    findAll()
 * @method Logs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogsRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Logs::class);
        $this->manager = $manager;
    }

    public function save(Logs $logs): Logs
    {
        $this->manager->persist($logs);
        $this->manager->flush();

        return $logs;
    }

    public function getLogs($user_id)
    {
        $logs = parent::findBy(array('userId' => $user_id));
        if ($logs == null){
            throw new \RuntimeException('Logy nebyly nalezeny');
        }
        $ret = [];
        foreach ($logs as $val) {
            $ret[] = array(
                'date' => $val->getDate(),
                'ip' => long2ip($val->getIp())
            );
        }
        return $ret;
    }




    // /**
    //  * @return Logs[] Returns an array of Logs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Logs
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
