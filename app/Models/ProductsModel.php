<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
	protected $table                = 'tb_products';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['id', 'description', 'price', 'uuid'];
}
