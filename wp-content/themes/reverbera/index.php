<?php include('partials/header.php'); ?>

    <section aria-labeledby="mainTitle" class="c-section c-section--main-section">
        <div class="c-container c__center">

            <h1 id="mainTitle" class="c__title c__white-text c-title--main-title c__center">
            <span class="c__section-title__big-title">
                Reverbera
            </span>
                <br>O conhecimento através dos seus ouvidos
            </h1>
        </div>
    </section>

    <section class="c-section">
        <div class="c-container c__center">
            <div class="l-flex l-flex--container">
                <?php include('partials/side-menu.php') ?>
                <main id="conteudo" accesskey="1" class="c-content-wrapper">

                    <div class="c-breadcrumb">
                        <div class="l-flex l-flex--center">
                            <div id="breadcrumb" class="c-bread-crumb__description">
                                Você está aqui:
                            </div>
                            <ol role="navigation" class="l-flex">
                                <li class="c-breadcrumb__link">
                                    <a href="#" aria-current="page" class="c__link c__trasition300">
                                        Página inicial
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <h2 class="c__title c__center">
                        Nossa missão
                    </h2>
                    <p class="c__paragraph">
                        A Reverbera surgiu com a necessidade de ampliar os meios de acesso à audiolivros
                        online de maneira gratuita e acessível. Contribuindo com a reverberação do conhecimento e
                        diminuição
                        das barreiras digitais.
                    </p>
                    <h2 class="c__title c__center">
                        Últimos lançamentos
                    </h2>
                    <ul class="l-flex l-flex--center l-flex__wrap">

                        <?php
                        $args = array('post_type' => 'audiolivro', 'posts_per_page' => 6);
                        $query = new WP_Query($args);
                        while ($query->have_posts()) : $query->the_post();
                            include('partials/audiobook-item.php');
                        endwhile; ?>

                    </ul>
                </main>
            </div>
        </div>
    </section>
<?php include('partials/footer.php'); ?>