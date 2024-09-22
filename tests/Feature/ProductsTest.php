<?php
use App\Models\Product;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    // ...

    public function test_homepage_contains_non_empty_table(): void
    {
        $product = Product::create([
            'name'  => 'Product 1',
            'price' => 123,
        ]);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee(__('No products found'));
        $response->assertSee('Product 1');
        $response->assertViewHas('products', function (LengthAwarePaginator $collection) use ($product) {
            return $collection->contains($product);
        });
    }

    public function test_paginated_products_table_doesnt_contain_11th_record()
    {
        $products = Product::factory(11)->create();
        $lastProduct = $products->last();

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function (LengthAwarePaginator $collection) use ($lastProduct) {
            return $collection->doesntContain($lastProduct);
        });
    }
}
