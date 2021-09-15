<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\FileVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FileVersion|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileVersion|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileVersion[]    findAll()
 * @method FileVersion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileVersionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileVersion::class);
    }
}
