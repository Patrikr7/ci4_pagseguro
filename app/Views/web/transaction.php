<div class="row">
    <div class="col-12 mt-3">
        <h1>Detalhes da Transação</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Informações</h4>
            </div>
            <div class="card-body">
                <p class="mb-0"><b>Status:</b> <?php echo PagSeguroStatus($transaction->getStatus()); ?></p>
                <p class="mb-0"><b>Código da transação:</b> <?php echo $transaction->getCode(); ?></p>
                <p class="mb-0"><b>Total:</b> R$ <?php echo number_format((($transaction->getPaymentMethod()->getType() === '2') ? ($transaction->getGrossAmount() + 1) : $transaction->getGrossAmount()), 2,',', '.'); ?></p>
                <p class="mb-0"><b>Meio de pagamento:</b> <?php echo PagSeguroType($transaction->getPaymentMethod()->getType()) . " (pagamento em {$transaction->getInstallmentCount()}x)" ?></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Produtos</h4>
            </div>
            <div class="card-body">

                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaction->getItems() as $item): ?>
                        <tr>
                            <th><?php echo $item->getId(); ?></th>
                            <th><?php echo $item->getDescription(); ?></th>
                            <th><?php echo $item->getQuantity(); ?></th>
                            <th>R$ <?php echo number_format($item->getAmount(), 2,',', '.'); ?></th>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>