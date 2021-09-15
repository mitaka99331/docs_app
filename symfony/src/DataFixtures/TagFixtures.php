<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    private array $tags = [
        ['name' => 'asd', 'type' => 'user', 'status' => true],
        ['name' => 'admin', 'type' => 'user', 'status' => true],
        ['name' => 'asd3', 'type' => 'user', 'status' => false],
        ['name' => 'superadmin', 'type' => 'user', 'status' => true],
        ['name' => 'user', 'type' => 'user', 'status' => true],

        ['name' => 'Group1', 'type' => 'group', 'status' => true],
        ['name' => 'Group2', 'type' => 'group', 'status' => true],
        ['name' => 'Group3', 'type' => 'group', 'status' => false],
        ['name' => 'Group4', 'type' => 'group', 'status' => true],
        ['name' => 'Group5', 'type' => 'group', 'status' => true],

        ['name' => 'Category1', 'type' => 'category', 'status' => true],
        ['name' => 'Category2', 'type' => 'category', 'status' => true],
        ['name' => 'Category3', 'type' => 'category', 'status' => false],
        ['name' => 'Category4', 'type' => 'category', 'status' => true],
        ['name' => 'Category5', 'type' => 'category', 'status' => true],

        ['name' => 'Subcategory1', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory2', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory3', 'type' => 'subcategory', 'status' => false],
        ['name' => 'Subcategory4', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory5', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory6', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory7', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory8', 'type' => 'subcategory', 'status' => false],
        ['name' => 'Subcategory9', 'type' => 'subcategory', 'status' => true],
        ['name' => 'Subcategory10', 'type' => 'subcategory', 'status' => true],

        ['name' => 'File1', 'type' => 'file', 'status' => true],
        ['name' => 'File2', 'type' => 'file', 'status' => true],
        ['name' => 'File3', 'type' => 'file', 'status' => false],
        ['name' => 'File4', 'type' => 'file', 'status' => true],
        ['name' => 'File5', 'type' => 'file', 'status' => true],
        ['name' => 'File6', 'type' => 'file', 'status' => false],
        ['name' => 'File7', 'type' => 'file', 'status' => true],
        ['name' => 'File8', 'type' => 'file', 'status' => true],
        ['name' => 'File9', 'type' => 'file', 'status' => false],
        ['name' => 'File10', 'type' => 'file', 'status' => true],
        ['name' => 'File11', 'type' => 'file', 'status' => true],
        ['name' => 'File12', 'type' => 'file', 'status' => false],
        ['name' => 'File13', 'type' => 'file', 'status' => true],
        ['name' => 'File14', 'type' => 'file', 'status' => true],
        ['name' => 'File15', 'type' => 'file', 'status' => false],
        ['name' => 'File16', 'type' => 'file', 'status' => true],
        ['name' => 'File17', 'type' => 'file', 'status' => true],
        ['name' => 'File18', 'type' => 'file', 'status' => true],
        ['name' => 'File19', 'type' => 'file', 'status' => true],
        ['name' => 'File20', 'type' => 'file', 'status' => true],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->tags as $tag) {
            $newTag = new Tag();

            $newTag->setName($tag['name'])
                ->setType($tag['type'])
                ->setStatus($tag['status']);

            $manager->persist($newTag);
            $this->addReference($tag['name'], $newTag);
        }

        $manager->flush();
    }
}
