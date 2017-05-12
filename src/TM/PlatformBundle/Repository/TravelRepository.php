<?php

namespace TM\PlatformBundle\Repository;

use DateTime;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class TravelRepository
 * @package TM\PlatformBundle\Repository
 */
class TravelRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $data
     * @param $page
     * @param $nbPerPage
     * @param $nbResults
     * @return Paginator
     */
    public function getTravelsByParameters($data, $page, $nbPerPage, &$nbResults)
    {
        $query = $this->createQueryBuilder('t');
        $query->select('t');

        if (isset($data['countries']) && !empty($data['countries'])) {
            $query->andWhere(
                $query->expr()->like(
                    't.countries',
                    $query->expr()->literal('%' . $data['countries'] . '%')
                )
            );
        }

        if (isset($data['begin']) && !empty($data['begin'])) {
            $data['begin'] = DateTime::createFromFormat('d/m/Y', $data['begin'])->format('Y-m-d');
            $query
                ->andWhere("t.startDate > '" . $data['begin'] . "'");
        }

        if (isset($data['end']) && !empty($data['end'])) {
            $data['end'] = DateTime::createFromFormat('d/m/Y', $data['end'])->format('Y-m-d');
            $query
                ->andWhere("t.startDate < '" . $data['end'] . "'");
        }

        if (isset($data['nbDuration']) && !empty($data['nbDuration'])) {
            $query
                ->andWhere('t.nbDuration = :nbDuration')
                ->setParameter('nbDuration', $data['nbDuration']);
        }

        if (isset($data['typeDuration']) && !empty($data['typeDuration'])) {
            $query
                ->andWhere('t.typeDuration = :typeDuration')
                ->setParameter('typeDuration', $data['typeDuration']);
        }

        if (isset($data['categories']) && !empty($data['categories'])) {
            $query
                ->join('t.categories', 'c')
                ->andWhere("c.id IN (:id)")
                ->setParameter('id', $data['categories']);
        }

        if (isset($data['cost']) && !empty($data['cost'])) {
            $query
                ->andWhere('t.cost = :cost')
                ->setParameter('cost', $data['cost']);
        }

        $nbResults = count($query->getQuery()->getResult());

        $query->setFirstResult(($page - 1) * $nbPerPage)
            ->setMaxResults($nbPerPage)
            ->orderBy('t.creationDate', 'DESC')
            ->getQuery();

        return new Paginator($query, true);
    }

    /**
     * @return mixed
     */
    public function getAllTravelCountryCode()
    {
        $query = $this->createQueryBuilder('t');
        $query->select('t.countries');
        return $query->getQuery()->getResult();
    }

    public function getLastTravelByCode($code, $limit)
    {
        $query = $this->createQueryBuilder('t');
        $query->select('t')
            ->where('t.countries LIKE :code')
            ->setParameter('code', "%" . $code . "%")
            ->setMaxResults($limit)
            ->orderBy('t.creationDate', 'DESC');
        return $query->getQuery()->getResult();
    }
}
