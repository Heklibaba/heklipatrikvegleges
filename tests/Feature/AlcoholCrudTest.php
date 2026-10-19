<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlcoholCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_and_products_can_be_saved_and_modified(): void
    {
        $this->post('/categories', ['name' => 'Whisky'])
            ->assertRedirect('/categories');

        $category = Category::where('name', 'Whisky')->firstOrFail();
        $this->post('/products', [
            'category_id' => $category->id,
            'name' => 'Teszt whisky',
            'alcohol_percent' => 40,
            'price' => 5990,
        ])->assertRedirect('/products');

        $product = Product::where('name', 'Teszt whisky')->firstOrFail();
        $this->get('/categories/'.$category->id)->assertOk()->assertSee('Whisky');
        $this->get('/products/'.$product->id)->assertOk()->assertSee('Teszt whisky');

        $this->put('/products/'.$product->id, [
            'category_id' => $category->id,
            'name' => 'Modositott whisky',
            'alcohol_percent' => 42,
            'price' => 6490,
        ])->assertRedirect('/products');

        $this->assertDatabaseHas('products', ['id' => $product->id, 'price' => 6490]);
        $this->delete('/products/'.$product->id)->assertRedirect('/products');
        $this->delete('/categories/'.$category->id)->assertRedirect('/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_invalid_product_values_are_rejected(): void
    {
        $this->post('/products', [
            'category_id' => 999,
            'name' => 'Hibas termek',
            'alcohol_percent' => 101,
            'price' => -1,
        ])->assertSessionHasErrors(['category_id', 'alcohol_percent', 'price']);

        $this->assertDatabaseCount('products', 0);
    }

    public function test_category_with_products_cannot_be_deleted(): void
    {
        $category = Category::create(['name' => 'Bor']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Teszt bor',
            'alcohol_percent' => 12,
            'price' => 1990,
        ]);

        $this->delete('/categories/'.$category->id)
            ->assertRedirect('/categories')
            ->assertSessionHasErrors('category');

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }
}
