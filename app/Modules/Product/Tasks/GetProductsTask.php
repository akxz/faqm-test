<?php

namespace App\Modules\Product\Tasks;

use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class GetProductsTask
{
    private $model;

    private $data;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function run($data)
    {
        $this->data = $data;
        $this->filterByCategories();
        $this->filterByMaterials();
        $this->filterByMealTypes();
        $this->filterByWeight();
        $this->filterByLength();
        $this->filterByWidth();
        $this->filterByHeight();

        return $this->model->with(['category', 'material', 'mealTypes'])->get();
    }

    private function filterByCategories()
    {
        if (isset($this->data['category'])) {
            $where = explode(',', $this->data['category']);
            $this->model = $this->model->whereIn('category_id', $where);

            return $this;
        }
    }

    private function filterByMaterials()
    {
        if (isset($this->data['material'])) {
            $where = explode(',', $this->data['material']);
            $this->model = $this->model->whereIn('material_id', $where);

            return $this;
        }
    }

    private function filterByMealTypes()
    {
        if (isset($this->data['meal_type'])) {
            $where = explode(',', $this->data['meal_type']);

            $this->model = $this->model->whereHas(
                'mealTypes',
                function (Builder $query) use ($where) {
                    $query->whereIn('id', $where);
                },
                '>=',
                1
            );

            return $this;
        }
    }

    private function filterByWeight()
    {
        if (isset($this->data['weight_from'])) {
            $this->model = $this->model
                ->where('weight', '>=', $this->data['weight_from']);
        }

        if (isset($this->data['weight_to'])) {
            $this->model = $this->model
                ->where('weight', '<=', $this->data['weight_to']);
        }

        return $this;
    }

    private function filterByLength()
    {
        if (isset($this->data['length_from'])) {
            $this->model = $this->model
                ->where('length', '>=', $this->data['length_from']);
        }

        if (isset($this->data['length_to'])) {
            $this->model = $this->model
                ->where('length', '<=', $this->data['length_to']);
        }

        return $this;
    }

    private function filterByWidth()
    {
        if (isset($this->data['width_from'])) {
            $this->model = $this->model
                ->where('width', '>=', $this->data['width_from']);
        }

        if (isset($this->data['width_to'])) {
            $this->model = $this->model
                ->where('width', '<=', $this->data['width_to']);
        }

        return $this;
    }

    private function filterByHeight()
    {
        if (isset($this->data['height_from'])) {
            $this->model = $this->model
                ->where('height', '>=', $this->data['height_from']);
        }

        if (isset($this->data['height_to'])) {
            $this->model = $this->model
                ->where('height', '<=', $this->data['height_to']);
        }

        return $this;
    }
}
