<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture implements DependentFixtureInterface
{
    private array $files = [
        ['name' => 'File1', 'directory' => 'Folder1', 'status' => true],
        ['name' => 'File2', 'directory' => 'Folder2', 'status' => true],
        ['name' => 'File3', 'directory' => 'Folder3', 'status' => true],
        ['name' => 'File4', 'directory' => 'Folder4', 'status' => true],
        ['name' => 'File5', 'directory' => 'Folder5', 'status' => true],
        ['name' => 'File6', 'directory' => 'Folder6', 'status' => false],
        ['name' => 'File7', 'directory' => 'Folder7', 'status' => false],
        ['name' => 'File8', 'directory' => 'Folder8', 'status' => false],
        ['name' => 'File9', 'directory' => 'Folder9', 'status' => true],
        ['name' => 'File10', 'directory' => 'Folder10', 'status' => false],
        ['name' => 'File11', 'directory' => 'Folder11', 'status' => true],
        ['name' => 'File12', 'directory' => 'Folder12', 'status' => true],
        ['name' => 'File13', 'directory' => 'Folder13', 'status' => false],
        ['name' => 'File14', 'directory' => 'Folder14', 'status' => true],
        ['name' => 'File15', 'directory' => 'Folder15', 'status' => true],
        ['name' => 'File16', 'directory' => 'Folder16', 'status' => false],
        ['name' => 'File17', 'directory' => 'Folder17', 'status' => true],
        ['name' => 'File18', 'directory' => 'Folder18', 'status' => true],
        ['name' => 'File19', 'directory' => 'Folder19', 'status' => false],
        ['name' => 'File20', 'directory' => 'Folder20', 'status' => true],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->files as $file) {
            $newFile = new File();

            $newFile->setName($file['name'])
                ->setDirectory($file['directory'])
                ->setStatus($file['status'])
                ->setFileTag($this->getReference($file['name'])->getId());

            $manager->persist($newFile);

            $this->addReference('file-'.$file['name'], $newFile);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
        ];
    }
}
