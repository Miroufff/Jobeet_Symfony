<?php
/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 20/05/16
 * Time: 15:39
 */

namespace Ens\SylvainDavenelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getWithJobs()
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT c FROM EnsSylvainDavenelBundle:Category c LEFT JOIN c.jobs j WHERE j.expiresAt > :date'
        )->setParameter('date', date('Y-m-d H:i:s', time()));

        return $query->getResult();
    }
}