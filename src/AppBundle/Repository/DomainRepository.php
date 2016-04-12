<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Domain;

/**
 * DomainRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DomainRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDomain($url)
    {

        $domain = null;
        try {
            $data = parse_url($url);
            if (isset($data['host'])) {
                $domain = $this->createQueryBuilder("d")
                    ->select("d")
                    ->where("d.name = :domain")->setParameter("domain", $data['host'])
                    ->getQuery()->getOneOrNullResult();
                if (!$domain) {
                    $domain = new Domain();
                    $domain->setName($data['host']);
                }
            }
        } catch (Exception $e) {

        }
        return $domain;
    }
}
