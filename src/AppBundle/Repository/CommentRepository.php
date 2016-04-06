<?php

namespace AppBundle\Repository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findLastComments($commentsNumber)
    {
        $qb = $this->createQueryBuilder("c");

        $query = $qb
            ->select("c, u, l")
            ->join("c.user", "u")
            ->join("c.link", "l")
            ->orderBy("c.added", "DESC");

        $query->setMaxResults(5);

        return $query->getQuery()->getResult();
    }
}
