<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method File|null find($id, $lockMode = null, $lockVersion = null)
 * @method File|null findOneBy(array $criteria, array $orderBy = null)
 * @method File[]    findAll()
 * @method File[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, File::class);
    }

    public function getFilesBySubcategory(int $subcategoryId): array
    {
        $sql = 'WITH RECURSIVE categories (parent, child)  as ( 
                    SELECT parent_id, child_id FROM ontology
                    JOIN tag ON (ontology.child_id = tag.id AND tag.status = 1)
                    WHERE parent_id = :subcategoryId
                  UNION
                    SELECT ontology.parent_id, ontology.child_id FROM ontology JOIN categories ON categories.child = ontology.parent_id 
                ) 
                SELECT file.name, file.directory , file_version.date, file_version.description FROM categories
                JOIN file ON (categories.child = file.file_tag AND file.status = 1)
                JOIN file_version ON (file.id = file_version.file_id AND file_version.status = 1);;';
        try {
            return $this->getEntityManager()->getConnection()->fetchAllAssociative($sql, ['subcategoryId' => $subcategoryId]) ?: [];
        } catch (Exception $e) {
            echo $e->getMessage();

            return [];
        }
    }
}
