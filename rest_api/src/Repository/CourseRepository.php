<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Enum\CourseFieldOrder;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }
    
    public function getPage(int $page, int $pageSize, $options = [])
    {
        $res = $this->createQueryBuilder('c');
        $res = $this->findWhere($res, $options);

        // ORDER BY
        $res = $this->orderBy($res, $options);
        /*
        $asc_or_desc = 'DESC';
        $getFieldOrder = "c.created_date";
        if (array_key_exists("order", $options))
        {
            $order = $options["order"];
            $asc_or_desc = $order & CourseFieldOrder::DESC ? 'DESC' : 'ASC';
            $getFieldOrder = $this->getFieldOrder($order);
        }
        */

        return $res
            //->orderBy($getFieldOrder, $asc_or_desc)
            ->setFirstResult(($page - 1) * $pageSize)
            ->setMaxResults($pageSize)
            ->getQuery()
            ->getResult();
    }

    public function countCourses($options = [])
    {
        $res = $this->createQueryBuilder('c');
        $res = $this->findWhere($res, $options);
        return $res->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findWhere($qb, $options)
    {
        // NAME LIKE
        if (array_key_exists("name", $options))
        {
            $qb->where('c.name LIKE :name')
                ->setParameter('name', '%' . $options["name"] . '%');
        }
        return $qb;
    }

    public function orderBy($qb, $options)
    {
        // ORDER BY
        $asc_or_desc = 'DESC';
        $getFieldOrder = "c.created_date, c.name";
        if (array_key_exists("order", $options))
        {
            $order = $options["order"];
            $asc_or_desc = $order & CourseFieldOrder::DESC ? 'DESC' : 'ASC';
            $getFieldOrder = $this->getFieldOrder($order);
        }
        return $qb->orderBy($getFieldOrder, $asc_or_desc);
    }

    private function getFieldOrder($order)
    {
        $res = null;
        if (($order & CourseFieldOrder::RELEASE_DATE) != 0)
            $res = $res == null ? "c.created_date" : $res + ", c.created_date";

        if (!$res)
            return 'c.created_date, c.name';
        else
        {
            if (!strpos($res, 'c.name'))
                $res .= ', c.name';
            return $res;
        } 
    }

    // /**
    //  * @return Course[] Returns an array of Course objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Course
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
