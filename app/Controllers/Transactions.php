<?php

namespace App\Controllers;

class Transactions extends BaseController
{
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

	public function transactionId()
	{
		// http://localhost/Codeigniter4/ci4_pagseguro/public/transacao?transaction_id=879DE4C6-1A9C-466E-BC49-8BC369C39A89
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
