<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FileRepository;
use App\Repository\TagRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class CategoryController extends AbstractController
{
    private TagRepository $tagRepository;
    private FileRepository $fileRepository;

    public function __construct(TagRepository $tagRepository, FileRepository $fileRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * @Route("/category/{categoryId}", methods="GET", name="category_index", requirements={"categoryId"="\d+"})
     */
    public function index(int $categoryId): Response
    {
        $category = $this->tagRepository->getSubcategory($this->getUser()->getUserTag(), $categoryId);

        if (empty($category)) {
            throw $this->createNotFoundException('The category does not exist');
        }

        $allFileVersions = $this->fileRepository->getFilesBySubcategory($categoryId);

        $files = [];
        foreach ($allFileVersions as $file) {
            $files[$file['name']][] = $file;
        }

        return $this->render('category/body.html.twig', [
            'category' => $category,
            'files' => $files,
        ]);
    }
}
