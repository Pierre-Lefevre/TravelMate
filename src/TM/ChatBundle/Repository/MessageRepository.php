<?php

namespace TM\ChatBundle\Repository;

use DateTime;
use Doctrine\DBAL\Types\Type;

/**
 * Class MessageRepository
 * @package TM\ChatBundle\Repository
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $idUser
     * @return array
     */
    public function getDistinctReceiver($idUser)
    {
        $query = $this->createQueryBuilder('m')
            ->select('distinct r.id')
            ->join('m.receiver', 'r')
            ->where('m.sender = :id_sender')
            ->setParameter('id_sender', $idUser)
            ->orderBy('m.date', 'DESC')
            ->getQuery();

        $result      = $query->getResult();
        $idsReceiver = array_column($result, 'id');

        $query = $this->createQueryBuilder('m')
            ->select('distinct s.id')
            ->join('m.sender', 's')
            ->where('m.receiver = :id_receiver')
            ->setParameter('id_receiver', $idUser)
            ->orderBy('m.date', 'DESC')
            ->getQuery();

        $result    = $query->getResult();
        $idsSender = array_column($result, 'id');

        $ids = array_unique(array_merge($idsReceiver, $idsSender));

        $receivers = array();

        if (!empty($ids)) {
            $query = $this->_em->createQueryBuilder();
            $query->select('u')
                ->from('TM\UserBundle\Entity\User', 'u')
                ->where($query->expr()->in('u.id', $ids));
            $receivers = $query->getQuery()->getResult();
        }

        return $receivers;
    }

    /**
     * @param $idUser1
     * @param $idUser2
     * @return array
     */
    public function findMessagesOfConversation($idUser1, $idUser2)
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.sender = :id_sender1 AND m.receiver = :id_receiver1')
            ->setParameter('id_sender1', $idUser1)
            ->setParameter('id_receiver1', $idUser2)
            ->orWhere('m.sender = :id_sender2 AND m.receiver = :id_receiver2')
            ->setParameter('id_sender2', $idUser2)
            ->setParameter('id_receiver2', $idUser1)
            ->orderBy('m.date')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param $idUser1
     * @param $idUser2
     * @param $dateMin
     * @param $dateMax
     * @return array
     */
    public function findNewMessage($idUser1, $idUser2, $dateMin, $dateMax)
    {
        $dateTimeMin = new DateTime();
        $dateTimeMin->setTimestamp(round($dateMin / 1000));

        $dateTimeMax = new DateTime();
        $dateTimeMax->setTimestamp(round($dateMax / 1000));

        $query = $this->createQueryBuilder('m')
            ->where('m.sender = :id_sender AND m.receiver = :id_receiver')
            ->setParameter('id_sender', $idUser2)
            ->setParameter('id_receiver', $idUser1)
            ->andWhere('m.date >= :dateMin AND m.date < :dateMax')
            ->setParameter('dateMin', $dateTimeMin->format("Y-m-d H:i:s"))
            ->setParameter('dateMax', $dateTimeMax->format("Y-m-d H:i:s"))
            ->orderBy('m.date')
            ->getQuery();

        return $query->getResult();
    }
}
