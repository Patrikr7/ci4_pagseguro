<?php

namespace App\Controllers;

use App\Models\{
	ProductsModel, TransactionModel
};
use PagSeguro\Domains\Requests\Payment;

class Home extends BaseController
{
	/**
	 * Acesso a página principal
	 * @return mixed
	 */
	public function index()
	{
		$dados = [
			'title'    => 'Início',
			'products' => (new ProductsModel())->findAll(),
		];

		return $this->template->load('web/template/template', 'web/home', $dados);
	}

	/**
	 * Acesso a página de carrinho
	 * @return mixed
	 */
	public function cart()
	{
		$dados = [
			'title'    => 'Carrinho',
			'products' => (new ProductsModel())->findAll(),
		];

		return $this->template->load('web/template/template', 'web/cart', $dados);
	}

	/**
	 * Faz o processamento inserindo os produtos no PagSeguro
	 * em seguida gera o link de pagamento redirecionando para
	 * a página com o botão
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function purchase()
	{
		$transactionsModel = new TransactionModel();
		$productsModel = new ProductsModel();
		$payment = new Payment();
		$post = $this->request->getPost();

		if (isset($post['products']) && count($post['products']) > 0):
			$products = $productsModel->whereIn('id', $post['products'])->findAll();

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

			try {
				$transactionsModel->save(['status' => 1]);
				$idReference = $transactionsModel->insertID();

				$payment->setReference($idReference);
				$payment->setSender()->setName($post['name']);
				$payment->setSender()->setEmail($post['email']);
				$payment->setSender()->setPhone()->withParameters($post['ddd'], clean($post['tel']));
				$payment->setSender()->setDocument()->withParameters('CPF', clean($post['cpf']));

				$payment->setRedirectUrl(base_url());
				$payment->setNotificationUrl(base_url('nofitication'));

				try {
					$link = $payment->register(
						\PagSeguro\Configuration\Configure::getAccountCredentials()
					);

					$onlyCheckoutCode = true;
					$result = $payment->register(
						\PagSeguro\Configuration\Configure::getAccountCredentials(),
						$onlyCheckoutCode
					);

					$dados = [
						'title'  => 'Efetuar pagamento',
						'link'   => $link,
						'result' => $result,
						'javascript' => (PAG_ENV === 'sandbox' ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js'),
						'location' => (PAG_ENV === 'sandbox' ? 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' : 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='),
					];

					return $this->template->load('web/template/template', 'web/payment', $dados);

				} catch (\Exception $e) {
					$transactionsModel->delete($idReference);
					session()->setFlashData('msg', $e->getMessage());
					return redirect()->route('home'); 
				}
			} catch (\Exception $e) {
				session()->setFlashData('msg', $e->getMessage());
				return redirect()->route('home');

			}

		else:
			session()->setFlashData('msg', 'Nenhum produto selecionado!');
			return redirect()->route('home');
		endif;
	}
}
