<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends EntityRepository
{

    public function getMessage() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM DBdbBundle:Message p ORDER BY p.editDate ASC'
            )
            ->getResult();
    }

    public function getMessageReceiver($receiverId) {
        $qb = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.receiver = :receiver_id')
            ->addOrderBy('m.editDate')
            ->setParameter('receiver_id', $receiverId);

        return $qb->getQuery()
            ->getResult();
    }

    public function getMessageReceiverOfSender($receiverId, $senderId) {
        $qb = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.receiver = :receiver_id')->setParameter('receiver_id', $receiverId)
            ->andWhere('m.sender = :sender_id')->setParameter('sender_id', $senderId)
            ->addOrderBy('m.editDate');


        return $qb->getQuery()
            ->getResult();
    }


    public function getMessageSenderOfReceiver($senderId, $receiverId) {
        $qb = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.receiver = :receiver_id')->setParameter('receiver_id', $receiverId)
            ->andWhere('m.sender = :sender_id')->setParameter('sender_id', $senderId)
            ->addOrderBy('m.editDate');

        return $qb->getQuery()
            ->getResult();
    }

    public function getListMessage($receiverId, $senderId) {
        $qb = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.receiver = :receiver_id')->setParameter('receiver_id', $receiverId)
            ->andWhere('m.sender = :sender_id')->setParameter('sender_id', $senderId)
            ->addOrderBy('m.editDate');

        return $qb->getQuery()
            ->getResult();

    }

    public function getMessageSender($senderId) {
        $qb = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.sender = :sender_id')
            ->addOrderBy('m.editDate')
            ->setParameter('sender_id', $senderId);

        return $qb->getQuery()
            ->getResult();
    }

    public function getMessagebyOrder($receiverId, $senderId) {
        $qb = $this->createQueryBuilder('m')
            ->select('m.subject')
            ->where('m.receiver = :receiver_id')->setParameter('receiver_id', $receiverId)
            ->andWhere('m.sender = :sender_id')->setParameter('sender_id', $senderId)
            ->orderBy('m.editDate');
        return $qb->getQuery()
            ->getResult();
    }
    public function getAllMessage() {
        $qb = $this->createQueryBuilder('m')
            ->select('m.subject')
//            ->where('m.receiver = :receiver_id')->setParameter('receiver_id', $receiverId)
            //          ->andWhere('m.sender = :sender_id')->setParameter('sender_id', $senderId)
            ->orderBy('m.editDate');
        return $qb->getQuery()
            ->getResult();
    }
}
