<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function getCategories(int $userTagId): array
    {
        $sql = 'WITH RECURSIVE categories (parent, child)  as ( 
                    SELECT parent_id, child_id FROM ontology
                    JOIN tag ON (ontology.child_id = tag.id AND tag.status = 1)
                    WHERE parent_id = :userTagId
                  UNION
                    SELECT ontology.parent_id, ontology.child_id FROM ontology JOIN categories ON categories.child = ontology.parent_id 
                ) 
                SELECT categories.parent, categories.child, tag.name, tag.type FROM categories
                JOIN tag ON (categories.child = tag.id AND tag.status = 1)
                GROUP BY(tag.name)';

        try {
            return $this->getEntityManager()->getConnection()->fetchAllAssociative($sql, ['userTagId' => $userTagId]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return [];
    }
}
