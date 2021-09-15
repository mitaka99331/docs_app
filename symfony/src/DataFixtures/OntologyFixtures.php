<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class OntologyFixtures extends Fixture implements DependentFixtureInterface
{
    private array $relationships = [
        ['parent' => 'asd', 'children' => ['Group1', 'Group2', 'Group3', 'Group4', 'Group5', 'Subcategory5']],
        ['parent' => 'admin', 'children' => ['Group4', 'Group5', 'Group3']],
        ['parent' => 'asd3', 'children' => ['Group1', 'Group2', 'Group3', 'Group5']],
        ['parent' => 'superadmin', 'children' => ['Group1', 'Group4', 'Group5']],
        ['parent' => 'user', 'children' => ['Group1', 'Group3']],

        ['parent' => 'Group1', 'children' => ['Category1', 'Category2', 'Subcategory9', 'Subcategory10']],
        ['parent' => 'Group2', 'children' => ['Category3', 'Category4', 'Category5']],
        ['parent' => 'Group3', 'children' => ['Category1', 'Category2', 'Category3', 'Category5']],
        ['parent' => 'Group4', 'children' => ['Category1', 'Category4', 'Category5']],
        ['parent' => 'Group5', 'children' => ['Category1', 'Category2', 'Category3']],

        ['parent' => 'Category1', 'children' => ['Subcategory1', 'Subcategory2']],
        ['parent' => 'Category2', 'children' => ['Subcategory3']],
        ['parent' => 'Category3', 'children' => ['Subcategory4', 'Subcategory5']],
        ['parent' => 'Category4', 'children' => ['Subcategory6', 'Subcategory7', 'Subcategory8']],
        ['parent' => 'Category5', 'children' => ['Subcategory9', 'Subcategory10']],

        ['parent' => 'Subcategory1', 'children' => ['File1', 'File2', 'File3']],
        ['parent' => 'Subcategory2', 'children' => ['File4']],
        ['parent' => 'Subcategory3', 'children' => ['File5', 'File6', 'File7']],
        ['parent' => 'Subcategory4', 'children' => ['File8']],
        ['parent' => 'Subcategory5', 'children' => ['File9', 'File10']],
        ['parent' => 'Subcategory6', 'children' => ['File11', 'File12', 'File13']],
        ['parent' => 'Subcategory7', 'children' => ['File14']],
        ['parent' => 'Subcategory8', 'children' => ['File15', 'File16', 'File17']],
        ['parent' => 'Subcategory9', 'children' => ['File18']],
        ['parent' => 'Subcategory10', 'children' => ['File19', 'File20']],
    ];

    public function load(ObjectManager $manager): void
    {
        $sql = 'INSERT IGNORE INTO ontology (parent_id, child_id) VALUES ';
        $bindParams = [];
        $index = 0;

        foreach ($this->relationships as $relationship) {
            foreach ($relationship['children'] as $child) {
                $sql .= '(:'.$index.'parent_id,:'.$index.'child_id),';

                $bindParams[$index.'parent_id'] = $this->getReference($relationship['parent'])->getId();
                $bindParams[$index.'child_id'] = $this->getReference($child)->getId();
                ++$index;
            }
        }

        $sql = rtrim($sql, ',');

        try {
            /* @phpstan-ignore-next-line */
            $stmt = $manager->getConnection()->prepare($sql);
            $stmt->executeStatement($bindParams);
        } catch (Exception | \Doctrine\DBAL\Driver\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
            FileFixtures::class,
        ];
    }
}
