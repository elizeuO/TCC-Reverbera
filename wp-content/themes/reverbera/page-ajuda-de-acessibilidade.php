<?php include ('partials/header.php'); ?>

    <section class="c-section c-section--main-section">
        <div class="c-container c__center">
            <h1 class="c__title c__white-text c-title--main-title c__center">
            <span class="c__section-title__big-title">
            <?= the_title() ?>
            </span>
            </h1>
        </div>
    </section>
    <section class="c-section">
        <div class="c-container c__center">
            <div class="l-flex l-flex--container">
                <?php include('partials/side-menu.php') ?>
                <main id="conteudo" accesskey="1" class="c-content-wrapper">
                    <div class="c-breadcrumb">
                        <div class="l-flex l-flex--center l-flex__wrap">

                            <div id="breadcrumb" class="c-bread-crumb__description">
                                Você está aqui:
                            </div>
                            <ol role="navigation" class="l-flex">

                                <li class="c-breadcrumb__link">
                                    <a href="index.php" class="c__link c__trasition300">
                                        Página
                                        Inicial
                                    </a>
                                </li>

                                <li class="c-breadcrumb__link">
                                    <a href="page-ajuda-de-acessibilidade.php" aria-current="page"
                                       class="c__link c__trasition300 w--current">
                                        Ajuda de Acessibilidade
                                    </a>
                                </li>

                            </ol>
                        </div>
                    </div>

                    <?= get_post_field('post_content', $post->ID) ?>
                </main>
            </div>
        </div>
    </section>
<?php include ('partials/footer.php'); ?>