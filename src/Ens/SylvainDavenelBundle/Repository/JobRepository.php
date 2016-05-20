<?php

namespace Ens\SylvainDavenelBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class JobRepository
 *
 * @package Ens\SylvainDavenelBundle\Repository
 */
class JobRepository extends EntityRepository
{
    public function getActiveJobs($idCategory = null, $max = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('j')
            ->where('j.expiresAt > :date')
            ->setParameter('date', date('Y-m-d H:i:s', time()))
            ->orderBy('j.expiresAt', 'DESC');

        if($max)
        {
            $qb->setMaxResults($max);
        }

        if($offset)
        {
            $qb->setFirstResult($offset);
        }

        if($idCategory)
        {
            $qb->andWhere('j.category = :id_category')
                ->setParameter('id_category', $idCategory);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getActiveJob($id)
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.id = :id')
            ->setParameter('id', $id)
            ->andWhere('j.expiresAt > :date')
            ->setParameter('date', date('Y-m-d H:i:s', time()))
            ->setMaxResults(1)
            ->getQuery();

        try {
            $job = $query->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $job = null;
        }

        return $job;
    }

    public function countActiveJobs($idCategory = null)
    {
        $qb = $this->createQueryBuilder('j')
            ->select('count(j.id)')
            ->where('j.expiresAt > :date')
            ->setParameter('date', date('Y-m-d H:i:s', time()));

        if($idCategory)
        {
            $qb->andWhere('j.category = :id_category')
                ->setParameter('id_category', $idCategory);
        }

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}