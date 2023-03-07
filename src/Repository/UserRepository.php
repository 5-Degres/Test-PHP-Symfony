<?php

/*
 *
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for user information.
 *
 * See https://symfony.com/doc/current/doctrine.html#querying-for-objects-the-repository
 *
 * @author Andrea Porcella <andreaporcella@gmail.com>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAll(): array
    {
        $qb = $this->createQueryBuilder('u')
            ->orderBy('u.fullName', 'DESC')
            ->getQuery()
            ->getResult()
        ;
        return $qb;
    }
}
