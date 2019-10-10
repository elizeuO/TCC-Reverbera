<?php include('partials/header.php') ?>
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
                                <a href="categoria-de-audiolivros.php" class="c__link c__trasition300">
                                    Categoria: Aventura
                                </a>
                            </li>

                            <li class="c-breadcrumb__link">
                                <a href="pagina-do-audiolivro.php" class="c__link c__trasition300">
                                    Audiolivro: Contos do
                                    Norte
                                </a>
                            </li>

                            <li class="c-breadcrumb__link">
                                <a href="pagina-do-autor.php" aria-current="page"
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
                            <img src="images/João-Marques-de-carvalho.jpg" alt="Foto do autor">
                        </div>

                        <div class="l__col-8">
                            <h2 class="c__title">
                                João Marques de Carvalho
                            </h2>
                            <p class="c__paragraph c-paragraph--info">
                                Além de diplomata, foi escritor e jornalista. João
                                Marques de Carvalho foi um brasileiro culto que concluiu os estudos em Lisboa, morou na
                                França e voltou ao Brasil para seguir a carreira de jornalista no Diário de Belém, em
                                1884. Mas, ao tentar publicar no periódico o conto “Que bom marido!” teve seu pedido
                                negado, rompendo assim seus laços com o veículo. Um dia depois o conto saiu em A
                                Província do Pará e, mais tarde, também em Contos Paraenses (1889). Ainda jornalista, em
                                1887 tornou-se um dos fundadores e o redator-chefe do Diário do Comércio do Pará. No ano
                                seguinte publicou “Hortência”, um romance naturalista que retrata um incesto entre dois
                                irmãos, que se tornou a sua principal obra. Sua carreira jornalística e literária foi
                                interrompida pela diplomática, mas após a acusação de crimes de peculato e estelionato
                                retomou as atividades no A Província do Pará e fundou a Academia Paraense de Letras.
                                Pouco tempo depois, fica doente, muda-se para Nice e falece em abril de 1910.
                            </p>
                        </div>
                    </div>
                </div>
                <h2 class="c__title c__center">
                    Audiolivros do autor
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
<?php include ('partials/footer')?>