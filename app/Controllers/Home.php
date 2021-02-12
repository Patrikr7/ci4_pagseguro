<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use PagSeguro\Domains\Requests\Payment;

class Home extends BaseController
{
	public function index()
	{
		$dados = [
			'title'    => 'Início',
			'products' => (new ProductsModel())->findAll(),
		];

		return $this->template->load('web/template/template', 'web/home', $dados);
	}

	public function close()
	{
		$post = $this->request->getPost();

		if (isset($post['products']) && count($post['products']) > 0):
			$products = (new ProductsModel())->whereIn('id', $post['products'])->findAll();

			$payment = new Payment();
			$payment->setCurrency('BRL');
			$payment->setNotificationUrl(base_url('notification'));

			foreach ($products as $product):
				$payment->addItems()->withParameters(
					$product['id'],
					$product['description'],
					1,
					$product['price']
				);
			endforeach;

			$payment->setSender()->setName($post['name']);
			$payment->setSender()->setEmail($post['email']);
			$payment->setSender()->setPhone()->withParameters($post['ddd'], clean($post['tel']));
			$payment->setSender()->setDocument()->withParameters('CPF', clean($post['cpf']));
			/*$payment->setShipping()->getAddress()->withParameters(
				'Rua Domingos Diegues',
				'2025',
				'Santa Felicia',
				'13563303',
				'São Carlos',
				'SP',
				'BRA',
				'Casa'
			);*/

			try {
				$link = $payment->register(
					\PagSeguro\Configuration\Configure::getAccountCredentials()
				);

				$dados = [
					'title' => 'Efetuar pagamento',
					'link'  => $link,
				];

				return $this->template->load('web/template/template', 'web/payment', $dados);

			} catch (\Exception $e) {
				session()->setFlashData('msg', $e->getMessage());
				return redirect()->route('home');
			}

		else:
			session()->setFlashData('msg', 'Nenhum produto selecionado!');
			return redirect()->route('home');
		endif;
	}

	public function transactions()
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
			die($e->getMessage());
		}
	}
}
