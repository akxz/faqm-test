<?php

namespace App\Modules\Order\Subactions;

use App\Modules\Order\Tasks\CalcBoxSizeTask;

class GetProductsBoxesSubaction
{
    private $boxes = [];

    private $currentBox;

    private $boxMealTypes;

    public function run($groupedProducts): array
    {
        // grouped by material
        foreach ($groupedProducts as $products) {
            $this->sortProductsIntoBoxes($products);
        }

        return $this->boxes;
    }

    private function sortProductsIntoBoxes(array $products): void
    {
        foreach ($products as $product) {
            if (empty($this->currentBox)) {
                $this->createNewBox($product);

                continue;
            }

            // same meal_types searching
            $intersect = $this->boxMealTypes
                ->intersect($product['meal_types'])
                ->all();

            if (! empty($intersect)) {
                $this->addProductToCurrentBox($product, $intersect);
            } else {
                $this->closeCurrentBox();
                $this->createNewBox($product);
            }
        }

        if (! empty($this->currentBox)) {
            $this->closeCurrentBox();
            $this->clearCurrentBox();
        }
    }

    private function createNewBox(array $product): void
    {
        $this->currentBox = $this->getSingleProductBox($product);
        $this->boxMealTypes = collect($product['meal_types']);
    }

    private function getSingleProductBox(array $product): array
    {
        return [
            'material' => $product['material_name'],
            'weight' => $product['weight'] * $product['count_items'],
            'products' => [$product],
            'meal_types' => $product['meal_types'],
        ];
    }

    private function closeCurrentBox(): void
    {
        $this->currentBox['size'] = $this->calcBoxSize($this->currentBox['products']);
        $this->boxes[] = $this->currentBox;
    }

    private function clearCurrentBox(): void
    {
        $this->currentBox = [];
    }

    private function addProductToCurrentBox(
        array $product,
        array $intersect
    ): void
    {
        $this->currentBox['weight'] += $product['weight'] * $product['count_items'];
        $this->currentBox['products'][] = $product;
        $this->currentBox['meal_types'] = $intersect;
        $this->boxMealTypes = collect($intersect);
    }

    private function calcBoxSize(array $products): array
    {
        $items = $this->getSizesByProducts($products);

        return app(CalcBoxSizeTask::class)->run($items);
    }

    private function getSizesByProducts(array $products): array
    {
        $items = [];

        foreach ($products as $product) {
            for ($i = 1; $i <= $product['count_items']; $i++) {
                $items[] = [
                    'length' => $this->calcProductLength($product),
                    'width' => $this->calcProductWidth($product),
                    'height' => $product['height'],
                ];
            }
        }

        return $this->getSortedItems($items);
    }

    private function calcProductLength(array $product): int
    {
        return max($product['length'], $product['width']);
    }

    private function calcProductWidth(array $product): int
    {
        return min($product['length'], $product['width']);
    }

    private function getSortedItems(array $items): array
    {
        return collect($items)
            ->sortBy([
                ['length', 'desc'],
                ['width', 'desc'],
                ['height', 'desc'],
            ])
            ->values()
            ->all();
    }

    private function sortDesc(array $items): array
    {
        return collect($items)->sortDesc()->values()->all();
    }
}
