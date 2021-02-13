<?php

namespace App\Controllers;

class Transactions extends BaseController
{
	/**
	 * Página com todas transações direto do PagSeguro
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function index()
	{
		$options = [
			'initial_date' => '2021-02-01T00:00',
			'page' => 1,
			'max_per_page' => 20,
		];

		try{
			$response = \PagSeguro\Services\Transactions\Search\Date::search(
				\PagSeguro\Configuration\Configure::getAccountCredentials(),
				$options
			);

			$dados = [
				'title' => 'Transações',
				'transactions'  => $response->getTransactions(),
			];

			return $this->template->load('web/template/template', 'web/transactions', $dados);

		}catch (\Exception $e){
			session()->setFlashData('msg', $e->getMessage());
			return redirect()->route('transactions');
		}
	}

	/**
	 * Página que será será redirecionado após o pagamento
	 * visualizando as informações do pagamento
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function transactionId()
	{
		try {
			$response = \PagSeguro\Services\Transactions\Search\Code::search(
				\PagSeguro\Configuration\Configure::getAccountCredentials(),
				$_GET['transaction_id']
			);

			$dados = [
				'title' => 'Transação',
				'transaction'  => $response,
			];

			return $this->template->load('web/template/template', 'web/transaction', $dados);

		}catch (\Exception $e){
			session()->setFlashData('msg', $e->getMessage());
			return redirect()->route('transaction');

		}
	}
}
