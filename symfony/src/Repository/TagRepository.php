<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function getSubcategory(int $userId, int $subcategoryId): array
    {
        $sql = 'WITH RECURSIVE subcategory (parent, child)  as ( 
                    SELECT parent_id, child_id FROM ontology 
                    JOIN tag ON (ontology.child_id = tag.id AND tag.status = 1)
                    WHERE parent_id = :userId
                  UNION
                    SELECT ontology.parent_id, ontology.child_id FROM ontology JOIN subcategory ON subcategory.child = ontology.parent_id 
                ) 
                SELECT tag.name FROM subcategory
                JOIN tag ON (subcategory.child = tag.id AND tag.status = true AND tag.id = :subcategoryId AND tag.type = "subcategory")';
        try {
            return $this->getEntityManager()->getConnection()->fetchAssociative($sql, ['userId' => $userId, 'subcategoryId' => $subcategoryId]) ?: [];
        } catch (Exception $e) {
            echo $e->getMessage();

            return [];
        }
    }
}
