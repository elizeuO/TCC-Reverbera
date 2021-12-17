<?php include('partials/header.php');
//stores the category name from the url
$categoryName = $_GET['categoria'];
?>
    <section class="c-section c-section--main-section">
        <div class="c-container c__center">
            <h1 class="c__title c__white-text c-title--main-title">
    <span class="c__section-title__big-title c__center">
    Categoria: <?= isset($categoryName) ? $categoryName : '' ?>
    </span>
            </h1>
        </div>
    </section>
    <section class="c-section">
        <div class="c-container c__center">
            <div class="l-flex l-flex--container">
                <?php include('partials/side-menu.php') ?>
                <main id="conteudo" accesskey="1" class="c-content-wrapper">

                    <?php include('partials/breadcrumb.php') ?>


                    <h2 class="c__title c__center">
                        Listagem de audiolivros
                    </h2>
                    <ul class="l-flex l-flex--center l-flex__wrap">
                        <?php
                        //shows the audiobooks that matches with the category name
                        $args = array('post_type' => 'audiolivro',
                            //Adds a taxonomy filter
                            'tax_query' => array(
                            array(
                                'taxonomy' => 'categorias',
                                'field' => 'slug',
                                'terms' => $categoryName
                            )
                        ),);
                        $query = new WP_Query($args);
                        while ($query->have_posts()) : $query->the_post();
                            include('partials/audiobook-item.php');
                        endwhile; ?>
                    </ul>
                </main>
            </div>
        </div>
    </section>
<?php include('partials/footer.php') ?>