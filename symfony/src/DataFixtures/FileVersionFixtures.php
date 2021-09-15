<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\FileVersion;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FileVersionFixtures extends Fixture implements DependentFixtureInterface
{
    private array $fileVersions = [
        ['name' => 'File1', 'directory' => 'Folder1', 'status' => true, 'description' => 'Description for file File1'],
        ['name' => 'File1', 'directory' => 'Folder1', 'status' => true, 'description' => 'Description for file File1'],
        ['name' => 'File1', 'directory' => 'Folder1', 'status' => true, 'description' => 'Description for file File1'],

        ['name' => 'File2', 'directory' => 'Folder2', 'status' => true, 'description' => 'Description for file File2'],
        ['name' => 'File2', 'directory' => 'Folder2', 'status' => true, 'description' => 'Description for file File2'],

        ['name' => 'File3', 'directory' => 'Folder3', 'status' => true, 'description' => 'Description for file File3'],

        ['name' => 'File4', 'directory' => 'Folder4', 'status' => true, 'description' => 'Description for file File4'],
        ['name' => 'File4', 'directory' => 'Folder4', 'status' => false, 'description' => 'Description for file File4'],
        ['name' => 'File4', 'directory' => 'Folder4', 'status' => true, 'description' => 'Description for file File4'],

        ['name' => 'File5', 'directory' => 'Folder5', 'status' => false, 'description' => 'Description for file File5'],
        ['name' => 'File5', 'directory' => 'Folder5', 'status' => false, 'description' => 'Description for file File5'],
        ['name' => 'File5', 'directory' => 'Folder5', 'status' => true, 'description' => 'Description for file File5'],

        ['name' => 'File6', 'directory' => 'Folder6', 'status' => false, 'description' => 'Description for file File6'],
        ['name' => 'File6', 'directory' => 'Folder6', 'status' => false, 'description' => 'Description for file File6'],

        ['name' => 'File7', 'directory' => 'Folder7', 'status' => false, 'description' => 'Description for file File7'],

        ['name' => 'File8', 'directory' => 'Folder8', 'status' => false, 'description' => 'Description for file File8'],
        ['name' => 'File8', 'directory' => 'Folder8', 'status' => false, 'description' => 'Description for file File8'],
        ['name' => 'File8', 'directory' => 'Folder8', 'status' => true, 'description' => 'Description for file File8'],
        ['name' => 'File8', 'directory' => 'Folder8', 'status' => false, 'description' => 'Description for file File8'],

        ['name' => 'File9', 'directory' => 'Folder9', 'status' => true, 'description' => 'Description for file File9'],

        ['name' => 'File10', 'directory' => 'Folder10', 'status' => false, 'description' => 'Description for file File10'],
        ['name' => 'File10', 'directory' => 'Folder10', 'status' => true, 'description' => 'Description for file File10'],
        ['name' => 'File10', 'directory' => 'Folder10', 'status' => true, 'description' => 'Description for file File10'],
        ['name' => 'File10', 'directory' => 'Folder10', 'status' => false, 'description' => 'Description for file File10'],

        ['name' => 'File11', 'directory' => 'Folder11', 'status' => false, 'description' => 'Description for file File11'],
        ['name' => 'File11', 'directory' => 'Folder11', 'status' => false, 'description' => 'Description for file File11'],
        ['name' => 'File11', 'directory' => 'Folder11', 'status' => true, 'description' => 'Description for file File11'],

        ['name' => 'File12', 'directory' => 'Folder12', 'status' => false, 'description' => 'Description for file File12'],
        ['name' => 'File12', 'directory' => 'Folder12', 'status' => false, 'description' => 'Description for file File12'],
        ['name' => 'File12', 'directory' => 'Folder12', 'status' => true, 'description' => 'Description for file File12'],

        ['name' => 'File13', 'directory' => 'Folder13', 'status' => false, 'description' => 'Description for file File13'],
        ['name' => 'File13', 'directory' => 'Folder13', 'status' => true, 'description' => 'Description for file File13'],
        ['name' => 'File13', 'directory' => 'Folder13', 'status' => true, 'description' => 'Description for file File13'],
        ['name' => 'File13', 'directory' => 'Folder13', 'status' => false, 'description' => 'Description for file File13'],

        ['name' => 'File14', 'directory' => 'Folder14', 'status' => false, 'description' => 'Description for file File14'],
        ['name' => 'File14', 'directory' => 'Folder14', 'status' => true, 'description' => 'Description for file File14'],
        ['name' => 'File14', 'directory' => 'Folder14', 'status' => true, 'description' => 'Description for file File14'],
        ['name' => 'File14', 'directory' => 'Folder14', 'status' => true, 'description' => 'Description for file File14'],

        ['name' => 'File15', 'directory' => 'Folder15', 'status' => false, 'description' => 'Description for file File15'],
        ['name' => 'File15', 'directory' => 'Folder15', 'status' => true, 'description' => 'Description for file File15'],
        ['name' => 'File15', 'directory' => 'Folder15', 'status' => true, 'description' => 'Description for file File15'],

        ['name' => 'File16', 'directory' => 'Folder16', 'status' => true, 'description' => 'Description for file File16'],
        ['name' => 'File16', 'directory' => 'Folder16', 'status' => true, 'description' => 'Description for file File16'],
        ['name' => 'File16', 'directory' => 'Folder16', 'status' => false, 'description' => 'Description for file File16'],

        ['name' => 'File17', 'directory' => 'Folder17', 'status' => false, 'description' => 'Description for file File17'],
        ['name' => 'File17', 'directory' => 'Folder17', 'status' => false, 'description' => 'Description for file File17'],
        ['name' => 'File17', 'directory' => 'Folder17', 'status' => true, 'description' => 'Description for file File17'],
        ['name' => 'File17', 'directory' => 'Folder17', 'status' => true, 'description' => 'Description for file File17'],

        ['name' => 'File18', 'directory' => 'Folder18', 'status' => true, 'description' => 'Description for file File18'],

        ['name' => 'File19', 'directory' => 'Folder19', 'status' => false, 'description' => 'Description for file File19'],
        ['name' => 'File19', 'directory' => 'Folder19', 'status' => true, 'description' => 'Description for file File19'],
        ['name' => 'File19', 'directory' => 'Folder19', 'status' => false, 'description' => 'Description for file File19'],
        ['name' => 'File19', 'directory' => 'Folder19', 'status' => false, 'description' => 'Description for file File19'],

        ['name' => 'File20', 'directory' => 'Folder20', 'status' => false, 'description' => 'Description for file File20'],
        ['name' => 'File20', 'directory' => 'Folder20', 'status' => true, 'description' => 'Description for file File20'],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->fileVersions as $key => $fileVersion) {
            $newFileVersion = new FileVersion();
            $date = new DateTime();

            $newFileVersion->setDescription($fileVersion['description'])
                ->setDate($date->add(DateInterval::createFromDateString(($key).' days')))
                ->setStatus($fileVersion['status'])
                ->setFileId($this->getReference('file-'.$fileVersion['name']));

            $manager->persist($newFileVersion);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FileFixtures::class,
        ];
    }
}
