<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_product()
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'Product 1',
            'description' => 'Description of Product 1',
            'price' => 100.00,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Product 1',
                     'description' => 'Description of Product 1',
                     'price' => 100.00,
                     'category_id' => $category->id,
                 ]);
    }

    // More tests for index, show, update, delete...
}