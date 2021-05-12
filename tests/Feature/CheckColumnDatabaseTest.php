<?php

namespace Tests\Feature;

use App\Entities\Client;
use App\Entities\Product;
use App\Entities\Sale;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckColumnDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function check_if_user_columns_is_correct()
    {
        $passenger = new User;

        $expected = [
            'name',
            'email',
            'password',
        ];

        $arrayCompared = array_diff($expected, $passenger->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }

    /** @test */
    public function check_if_client_columns_is_correct()
    {
        $passenger = new Client;

        $expected = [
            'name',
            'email',
            'cpf',
        ];

        $arrayCompared = array_diff($expected, $passenger->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }

    /** @test */
    public function check_if_product_columns_is_correct()
    {
        $passenger = new Product;

        $expected = [
            'name',
            'description',
            'price',
        ];

        $arrayCompared = array_diff($expected, $passenger->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }

    /** @test */
    public function check_if_sale_columns_is_correct()
    {
        $passenger = new Sale;

        $expected = [
            'product_id',
            'sale_date',
            'amount',
            'status',
            'discount',
        ];

        $arrayCompared = array_diff($expected, $passenger->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }

}
