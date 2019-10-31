<?php include('partials/header.php');
$author = get_post();
?>

    <section aria-labeledby="mainTitle" class="c-section c-section--main-section">
        <div class="c-container c__center">
            <h1 id="mainTitle" class="c__title c__white-text c-title--main-title">
          <span class="c__section-title__big-title c__center">
              Conheça o autor
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
                            <div class="c-bread-crumb__description">
                                Você está aqui:
                            </div>
                            <ol role="navigation" class="l-flex">

                                <li class="c-breadcrumb__link">
                                    <a href="index.php" class="c__link c__trasition300">
                                        Página Inicial
                                    </a>
                                </li>

                                <li class="c-breadcrumb__link">
                                    <a href="archive-audiolivro.php" class="c__link c__trasition300">
                                        Categoria: Aventura
                                    </a>
                                </li>

                                <li class="c-breadcrumb__link">
                                    <a href="single-audiolivro.php" class="c__link c__trasition300">
                                        Audiolivro: Contos do
                                        Norte
                                    </a>
                                </li>

                                <li class="c-breadcrumb__link">
                                    <a href="single-autor.php" aria-current="page"
                                       class="c__link c__trasition300 w--current">
                                        Autor: João
                                        Marques de carvalho
                                    </a>
                                </li>

                            </ol>
                        </div>
                    </div>
                    <div class="c-info-content">
                        <div class="l-flex l-flex--center l-flex__wrap">
                            <div class="l__col-4 l__col-4--25">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= the_field('coverAlt') ?>">
                            </div>

                            <div class=" l__col-8">
                                <h2 class="c__title">
                                    <?= the_title(); ?>
                                </h2>
                                <p class="c__paragraph c-paragraph--info">
                                    <?= $author->post_content; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h2 class="c__title c__center">
                        Audiolivros do autor
                    </h2>
                    <ul class="l-flex l-flex--center l-flex__wrap">
                        <?php
                        //shows the audiobooks the matches with the author
                        $args = array('post_type' => 'audiolivro');
                        $query = new WP_Query($args);
                        while ($query->have_posts()) : $query->the_post();
                            $fields = get_field('author');
                            foreach ($fields as $field) {
                                if ($field->post_title == $author->post_title) {
                                    include('partials/audiobook-item.php');
                                }
                            }
                        endwhile; ?>
                    </ul>
                </main>
            </div>
        </div>
    </section>
<?php include('partials/footer.php') ?>