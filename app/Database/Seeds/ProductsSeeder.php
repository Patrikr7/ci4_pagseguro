<?php

namespace App\Database\Seeds;

use App\Libraries\Uuid;
use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
	public function run()
	{
		$uuid = new Uuid();

		$data = [
			[
				'description' => 'Ebook 1001 Receitas Fitnes',
				'price'       => '59.90',
				'uuid'        => $uuid->v4(),
			],
			[
				'description' => 'Ebook 200 Receitas Detox',
				'price'       => '49.90',
				'uuid'        => $uuid->v4(),
			],
			[
				'description' => 'Ebook 50 Receitas Geladinho',
				'price'       => '39.90',
				'uuid'        => $uuid->v4(),
			],
			[
				'description' => 'Ebook 150 Receitas para Emagrecimento',
				'price'       => '79.90',
				'uuid'        => $uuid->v4(),
			],
		];

		$this->db->table('tb_products')->insertBatch($data);
	}
}
