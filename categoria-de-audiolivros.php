<?php include('partials/header.php') ?>
    <section class="c-section c-section--main-section">
        <div class="c-container c__center">
            <h1 class="c__title c__white-text c-title--main-title">
          <span class="c__section-title__big-title c__center">
              Categoria Aventura
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
                                        Página Inicial
                                    </a>
                                </li>

                                <li class="c-breadcrumb__link">
                                    <a href="categoria-de-audiolivros.php" aria-current="page"
                                       class="c__link c__trasition300 w--current">
                                        Categoria: Aventura
                                    </a>
                                </li>

                            </ol>
                        </div>
                    </div>
                    <h2 class="c__title c__center">
                        Listagem de audiolivros
                    </h2>
                    <ul class="l-flex l-flex--center l-flex__wrap">
                        <?php
                        include('partials/audiobook-item.php');
                        include('partials/audiobook-item.php');
                        include('partials/audiobook-item.php');
                        include('partials/audiobook-item.php');
                        include('partials/audiobook-item.php');
                        include('partials/audiobook-item.php');
                        ?>
                    </ul>
                </main>
            </div>
        </div>
    </section>
<?php include('partials/footer.php') ?>