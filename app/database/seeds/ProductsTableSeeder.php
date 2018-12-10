<?php

use Illuminate\Database\Seeder;

use Admin\Products\Entities\ProductEntity as Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Product::firstOrCreate([
            'id' => '1',
            'name' => 'Cerveja Brahma',
            'price' => '10.55',
        ]);

        Product::firstOrCreate([
            'id' => '2',
            'name' => 'Porcao Amendoim',
            'price' => '12.55',
        ]);
        
        Product::firstOrCreate([
            'id' => '3',
            'name' => 'Porcao Batata',
            'price' => '12.65',
        ]);
        
        Product::firstOrCreate([
            'id' => '4',
            'name' => 'Cerveja Skoll',
            'price' => '11.45',
        ]);

        Product::firstOrCreate([
            'id' => '5',
            'name' => 'Suco',
            'price' => '9.15',
        ]);
        
    }
}
