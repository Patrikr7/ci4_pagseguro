<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Carrinho</h4>
            </div>
            <div class="card-body">
				<?php
				$message = session()->getFlashData('msg');
				if (!empty($message)) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo $message ?>
                            </div>
                        </div>
                    </div>
				<?php endif; ?>

				<?php echo form_open('fechar', ['onsubmit' => 'document.getElementById("btn-enviar").disable=true']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-name">Nome</label>
                            <input type="text" class="form-control" id="input-name" name="name"
                                   value="Joaquim da Silva">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-email">Email</label>
                            <input type="email" class="form-control" id="input-email" name="email"
                                   value="c74839009654401324677@sandbox.pagseguro.com.br">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-cpf">CPF</label>
                            <input type="text" class="form-control" id="input-cpf" name="cpf" value="235.586.360-15">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="input-ddd">DDD</label>
                            <input type="text" class="form-control" id="input-ddd" name="ddd" value="16">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="input-tel">Telefone</label>
                            <input type="text" class="form-control" id="input-tel" name="tel" value="94926-0534">
                        </div>
                    </div>
                </div>

                <table class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($products as $product): ?>
                        <tr>
                            <th><?php echo $product['id']; ?></th>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo 'R$ ' . number_format($product['price'], 2, ',', '.'); ?></td>
                            <td><input type="checkbox" name="products[]" value="<?php echo $product['id']; ?>"/></td>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row no-gutters d-flex justify-content-end">
                    <button class="btn btn-success" type="submit" id="btn-enviar" onclick="this.innerHTML='Aguarde...'">
                        Fechar Compra
                    </button>
                </div>
				<?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>