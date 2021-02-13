<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class Notification extends BaseController
{
	/**
	 * Quando tiver mudança do pagamento
	 * atualiza no banco de dados o status
	 */
	public function index()
	{
		header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

		try{
			if(\PagSeguro\Helpers\Xhr::hasPost()):
				$response = \PagSeguro\Services\Transactions\Notification::check(
					\PagSeguro\Configuration\Configure::getAccountCredentials()
				);

				$dados = [
					'code' => $response->getCode(),
					'status' => $response->getStatus()
				];

				(new TransactionModel())->update($response->getReference(), $dados);

			else:
				throw new \InvalidArgumentException($_POST);
			endif;
		}catch (\Exception $e){
			die($e->getMessage());
		}
	}
}
