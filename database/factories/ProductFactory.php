<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'article' => $this->faker->unique()->bothify('?????#'),
            'status' => rand(0, 1) ? 'available' : 'unavailable',
            'data' => $this->getProps(),
        ];
    }

    protected function getProps()
    {
        $props = [];
        $fields = Arr::random(['цвет', 'размер', 'вес', 'код', 'объем', 'количество в упаковке'], rand(0, 5));

        foreach ($fields as $field) {
            $props[] = ['field' => $field, 'value' => $this->getPropValue($field)];
        }

        return json_encode($props, JSON_UNESCAPED_UNICODE);
    }

    protected function getPropValue(string $propName)
    {
        if ($propName === 'цвет') {
            return $this->faker->colorName;
        } elseif ($propName === 'размер') {
            return Arr::random(['M', 'S', 'L', 'XL', 'XXL', 'XXXL']);
        } elseif ($propName === 'вес') {
            return rand(0, 100) / 10 . ' кг';
        } elseif ($propName === 'код') {
            return Str::random(rand(6, 12));
        } elseif ($propName === 'объем') {
            return rand(0, 100) / 10 . ' л';
        } elseif ($propName === 'количество в упаковке') {
            return rand(1, 100);
        }

        return $this->faker->bothify;
    }
}
