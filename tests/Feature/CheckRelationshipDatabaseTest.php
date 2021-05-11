<?php

namespace Tests\Feature;

use App\Entities\Sale;
use App\Entities\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CheckRelationshipDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function check_if_product_has_many_sales()
    {
        $product= factory(Product::class)->create();
        $sale = factory(Sale::class)->create(['product_id' => $product->id]);

        $this->assertTrue($product->sales->contains($sale));
    }

    /** @test */
    public function check_if_sale_belongs_to_product()
    {
        $product = factory(Product::class)->create();
        $sale = factory(Sale::class)->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $sale->product);
    }

}
