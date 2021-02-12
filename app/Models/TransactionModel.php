<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
	protected $table                = 'tb_transactions';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['id', 'code', 'status'];
}
