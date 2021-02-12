<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Transações direto do PagSeguro</h4>
            </div>
            <div class="card-body">

                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Data</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <th><?php echo $transaction->getCode(); ?></th>
                                <td><?php echo date('d/m/Y', strtotime($transaction->getDate())); ?></td>
                                <td>R$ <?php echo number_format($transaction->getGrossAmount(), 2,',', '.'); ?></td>
                                <td><?php echo PagSeguroStatus($transaction->getStatus()); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>