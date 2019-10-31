<?php include('partials/header.php');

//gets the audiobook of the single page
$audiobook = get_post();

//gets the author of audiobook of the single page
$authorName = get_field('author');

//gets the audiobook file
$attachment_id = get_field('audioFile');
$metadata = wp_get_attachment_metadata($attachment_id);
$size = $metadata['filesize'];
$duration = $metadata['length_formatted'];
?>
    <section aria-labeledby="mainTitle" class="c-section c-section--main-section">
        <div class="c-container c__center">
            <h1 id="mainTitle" class="c__title c__white-text c-title--main-title">
          <span class="c__section-title__big-title c__center">
              Tenha uma boa leitura
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
                                    <a href="archive-audiolivro.php" aria-current="page"
                                       class="c__link c__trasition300">
                                        Categoria: Aventura
                                    </a>
                                </li>
                                <li class="c-breadcrumb__link">
                                    <a href="single-audiolivro.php" aria-current="page"
                                       class="c__link c__trasition300 w--current">
                                        Audiolivro: Contos do Norte
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
                            <div class="l__col-8">
                                <h2 class="c__title">
                                    <?= the_title(); ?>

                                </h2>
                                <p class="c__paragraph c-paragraph--info">
                                    <strong>
                                        Resumo:
                                    </strong>
                                    <?= $audiobook->post_content; ?>
                                </p>

                                <?php if ($authorName) { ?>
                                    <p class="c__paragraph c-paragraph--info c__link c__trasition300">
                                        <?php foreach ($authorName as $author): ?>
                                        <a href="<?= get_permalink($author) ?>" class="c__link">
                                            <strong>
                                                Autor:
                                            </strong>
                                            <?= ($author->post_title);
                                            endforeach; ?>
                                        </a>
                                    </p>
                                <?php } ?>
                                <p class="c__paragraph c-paragraph--info">
                                    <strong>
                                        Categoria:
                                    </strong>
                                    <?php
                                    $category = get_the_terms(get_post()->ID, 'categorias');
                                    foreach ($category as $term) {
                                        echo $term->name;
                                    }
                                    ?>

                                </p>

                                <?php if (get_field('publishingCompany')) { ?>
                                    <p class="c__paragraph c-paragraph--info">
                                        <strong>
                                            Editora:
                                        </strong>
                                        <?= the_field('publishingCompany') ?>
                                    </p>
                                <?php }

                                if (get_field('speaker')) { ?>

                                    <p class="c__paragraph c-paragraph--info">
                                        <strong>
                                            Locutor(a):
                                        </strong>
                                        <?= the_field('speaker') ?>

                                    </p>
                                <?php } ?>

                                <p class="c__paragraph c-paragraph--info">
                                    <strong>
                                        Duração:
                                    </strong>
                                    <?= $duration; ?>
                                </p>
                                <p class="c__paragraph c-paragraph--info">
                                    <strong>
                                        Tamanho:
                                    </strong>
                                    <?= size_format($size, 0); ?>
                                </p>
                                <div class="l__col-6">
                                    <?php include('partials/audioplayer.php') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
<?php include('partials/footer.php') ?>