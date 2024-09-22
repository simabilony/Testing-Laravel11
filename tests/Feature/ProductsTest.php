<?php

use App\Models\Product;
use Illuminate\Support\Collection;
use function Pest\Laravel\get;

test('homepage contains empty table', function () {
    get('/products')
        ->assertStatus(200)
        ->assertSee(__('No products found'));
});
// Arrange _ Act _ Assert
test('homepage contains non empty table', function () {
    Product::create([
        'name'  => 'Product 1',
        'price' => 123,
    ]);

    $product = 1;
    get('/products')
        ->assertStatus(200)
        ->assertDontSee(__('No products found'))
    ->assertSee('Product 1')
        ->assertViewHas('products', function (Collection $collection) use ($product) {
            return $collection->contains($product);
        });
});
