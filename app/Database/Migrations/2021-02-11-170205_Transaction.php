<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction extends Migration
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
			'code'        => [
				'type'       => 'varchar',
				'constraint' => '255',
				'null'       => true,
			],
			'status'         => [
				'type'       => 'char',
				'constraint' => '3',
				'null'       => true,
			],
		]);

		$this->forge->addPrimaryKey('id', true);
		$this->forge->addUniqueKey(['id'], true);

		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('transactions', true, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('tb_transactions', true);
	}
}
