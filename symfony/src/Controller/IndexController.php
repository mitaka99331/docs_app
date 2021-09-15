<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Utility\TreeBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class IndexController extends AbstractController
{
    private UserRepository $userRepository;
    private TreeBuilder $treeBuilder;

    public function __construct(UserRepository $userRepository, TreeBuilder $treeBuilder)
    {
        $this->userRepository = $userRepository;
        $this->treeBuilder = $treeBuilder;
    }

    /**
     * @Route("/", methods="GET", name="index_page")
     */
    public function index(): Response
    {
        return $this->render('base/home.html.twig');
    }

    public function sidebar(): Response
    {
        $userCategories = [];
        $userTag = $this->getUser()->getUserTag();

        if (isset($userTag)) {
            $userCategories = $this->userRepository->getCategories($userTag);
        }

        if (!empty($userCategories)) {
            $categories = $this->treeBuilder->buildCategoryTree($userCategories, (string) $userTag);
        }

        return $this->render('base/sidebar.html.twig', [
            'categories' => $categories ?? [],
        ]);
    }
}
