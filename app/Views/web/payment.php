<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Efetuar Pagamento</h4>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-12">
                        <p>Clique no botão abaixo para ser direcionado para a tela do PagSeguro e efetuar o seu pagamento.</p>
						<?php echo anchor($link, img(['src' => 'assets/images/pagseguro.png', 'alt' => 'Pagar com PagSeguro', 'class' => 'img-fluid', 'title' => 'Pagar com PagSeguro', 'width' => '220']), ['target' => '_blank']); ?>
                    </div>
                    <div class="col-12 py-4">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <p>Clique no botão abaixo para efetuar o seu pagamento via lightbox.</p>
                        <span class="btn" id="pag_lightbox" code="<?php echo $result->getCode(); ?>">
                            <?php echo img(['src' => 'assets/images/pagseguro.png', 'alt' => 'Pagar com PagSeguro', 'class' => 'img-fluid', 'title' => 'Pagar com PagSeguro', 'width' => '220']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo $javascript; ?>"></script>

<script>
    $(function(){
        $("#pag_lightbox").on("click", function(){
            const code = $(this).attr('code');

            const isOpenLightbox = PagSeguroLightbox(code, {
                success : function(transactionCode) {
                    window.location.href = "transacao?transacao_id="+transactionCode;
                },
                abort : function() {
                    window.location.href = "carrinho";
                }
            });

            // Redirecionando o cliente caso o navegador não tenha suporte ao Lightbox
            if (!isOpenLightbox){
                location.href="<?php echo $location; ?>"+code;
            }
        });
    });
</script>
