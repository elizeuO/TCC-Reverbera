<section class="c__section-form">
    <div class="c__container-form">
        <div class="col-md-12 c__box-title">
            <h1 class="c__title">Gerenciar Formulários</h1>
            <p>Insira os e-mails abaixo separando-os por vírugla <i>(ex: "exemplo@exemplo.com,
                    exemplo.1@exemplo.1.com...")</i>.</p>
        </div>
        <form action="" method="post" class="l-flex l-flex--wrap l-flex--start">
			<?php
			wp_nonce_field( $this::PAGE_SLUG, $this::PAGE_SLUG );

			foreach ( $this->forms as $key => $form ) {
				include "item-form.php";
			} ?>

            <div class="form-row col-md-12">
                <div class="col-md-12">
                    <h2 class="c__title">Google reCaptcha V3</h2>
                </div>

                <article class="form-group col-md-6 c__item-form">
                    <div>
                        <h4 class="c__title">Chave do Site</h4>
                    </div>
                    <input type="text" name="siteKey" value="<?= get_option('siteKey') ?>" class="form-control">
                </article>

                <article class="form-group col-md-6 c__item-form">
                    <div>
                        <h4 class="c__title">Chave Secreta</h4>
                    </div>
                    <input type="text" name="secretKey" value="<?= get_option('secretKey') ?>" class="form-control">
                </article>

                <div class="form-group col-md-12 c__container--submit">
                    <button type="submit" class="btn btn-primary btn-lg col-md-12">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</section>