<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'           => [
				'type'           => 'INT',
				'constraint'     => '11',
				'unsigned'       => true,
				'null'           => false,
				'auto_increment' => true,
			],
			'description'        => [
				'type'       => 'varchar',
				'constraint' => '190',
				'null'       => true,
			],
			'price'        => [
				'type'       => 'decimal',
				'constraint' => '11,2',
				'null'       => true,
			],
			'uuid'         => [
				'type'       => 'varchar',
				'constraint' => '190',
				'unique'     => true,
				'null'       => true,
			],
		]);

		$this->forge->addPrimaryKey('id', true);
		$this->forge->addUniqueKey(['id', 'uuid'], true);

		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('products', true, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('tb_products', true);
	}
}
