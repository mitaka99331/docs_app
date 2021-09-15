<?php

declare(strict_types=1);

namespace App\Utility;

class TreeBuilder
{
    public function buildCategoryTree(array $categories, string $parentId): array
    {
        asort($categories);
        $tree = $this->buildTree($categories, $parentId);

        //rearrange if user have additional subcategories
        $this->rearrangeAdditionalSubcategories($tree);

        //get groups children and merge them in one array
        $categoryTree = array_merge(...array_column($tree, 'children'));

        //rearrange if group have additional subcategories
        $this->rearrangeAdditionalSubcategories($categoryTree);

        return $categoryTree;
    }

    private function rearrangeAdditionalSubcategories(array &$list): void
    {
        foreach ($list as $key => $value) {
            if ('subcategory' === $value['type']) {
                $list['Other']['children'][$value['name']] = $value;

                unset($list[$key]);
            }
        }
    }

    private function buildTree(array &$elements, string $parentId): array
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent'] === $parentId) {
                $children = $this->buildTree($elements, $element['child']);
                if ($children) {
                    $element['children'] = $children;
                }

                $branch[$element['name']] = $element;

                unset($elements[$element['child']]);
            }
        }

        return $branch;
    }
}
