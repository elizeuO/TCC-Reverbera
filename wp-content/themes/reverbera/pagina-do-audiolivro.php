<?php include('partials/header.php') ?>
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
                                <a href="categoria-de-audiolivros.php" aria-current="page"
                                   class="c__link c__trasition300">
                                    Categoria: Aventura
                                </a>
                            </li>
                            <li class="c-breadcrumb__link">
                                <a href="pagina-do-audiolivro.php" aria-current="page"
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
                            <img src="assets/images/audiobook-example.jpg" alt="Capa do livro: Copa de árvores.">
                        </div>
                        <div class="l__col-8">
                            <h2 class="c__title">
                                Contos do Norte
                            </h2>
                            <p class="c__paragraph c-paragraph--info">
                                <strong>
                                    Resumo:
                                </strong>
                                Contos do Norte é uma coleção de contos ambientados na região norte do Brasil. Seu
                                autor, Marques de Carvalho, diz que seu livro se pretende &quot;uma homenagem ao povo
                                paraense&quot;. As histórias são, em geral, curtas e melancólicas, com os elementos da
                                floresta, dos rios amazônicos e das populações ribeirinhas em destaque.
                            </p>
                            <p class="c__paragraph c-paragraph--info c__link c__trasition300">
                                <a href="pagina-do-autor.php" class="c__link">
                                    <strong>
                                        Autor:
                                    </strong>
                                    João Marques
                                    de Carvalho
                                </a>
                            </p>
                            <p class="c__paragraph c-paragraph--info">
                                <strong>
                                    Categoria:
                                </strong>
                                Aventura
                            </p>
                            <p class="c__paragraph c-paragraph--info">
                                <strong>
                                    Editora:
                                </strong>
                                Librivox
                            </p>
                            <p class="c__paragraph c-paragraph--info">
                                <strong>
                                    Locutor(a):
                                </strong>
                                Briana
                            </p>
                            <p class="c__paragraph c-paragraph--info">
                                <strong>
                                    Duração:
                                </strong>
                                4 minutos e 42 segundos
                            </p>
                            <p class="c__paragraph c-paragraph--info">
                                <strong>
                                    Tamanho:
                                </strong>
                                2MB
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