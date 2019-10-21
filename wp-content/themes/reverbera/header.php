<!DOCTYPE html>
<html data-wf-page="5d7e40af17c02c404ddccfbb" data-wf-site="5d7e40af17c02c53c2dccfba">
<head>
    <meta lang="pt-br">
    <meta charset="utf-8">
    <title><?= wp_title(); ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?= get_template_directory_uri(); ?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?= get_template_directory_uri(); ?>/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?= get_template_directory_uri(); ?>/images/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/images/site.webmanifest">
    <link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <?php wp_head(); ?>
</head>
<body class="body">
<header id="menu" tabindex="0" accesskey="2" class="c-header">
    <div class="c-container">
        <div data-collapse="medium" data-animation="default" data-duration="400" role="navigation"
             class="c-header__nav w-nav">
            <ul class="l-flex l-flex--center l-flex__wrap">

                <li class="c-header__brand">
                    <a title="Início" href="<?= home_url(); ?>" class="w-inline-block w--current">
                        <img src="<?= get_template_directory_uri(); ?>/images/Logo_1.png"
                             alt="Reverbera, áudio livros gratuitos">
                    </a>
                </li>

                <li>
                    <a href="#conteudo" class="c__link c__trasition300">
                        Ir para o conteúdo [1]
                    </a>
                </li>

                <li>
                    <a href="#" class="c__link c__trasition300">
                        Ir para o o menu [2]
                    </a>
                </li>

                <li>
                    <a href="<?= get_permalink(get_page_by_path('ajuda-de-acessibilidade')) ?>" accesskey="3"
                       class="c__link c__trasition300">
                        Ajuda de acessibilidade [3]
                    </a>
                </li>

                <li>
                    <a id="increaseSize" title="Aumentar tamanho da fonte" aria-label="Aumentar fonte" role="button"
                       href="#" class="c__acessible-button c__trasition-300 c__acessible-button--left-margin w-button">
                        A+
                    </a>
                </li>

                <li>
                    <a id="decreaseSize" title="Diminuir tamanho da fonte" aria-label="Diminuir fonte" role="button"
                       href="#" class="c__acessible-button c__trasition-300 c__acessible-button--right-margin w-button">
                        A-
                    </a>

                </li>

                <li class="l-flex l-flex--center">
                    <div class="c-header__acessiblity-descripition">
                        Contraste
                    </div>

                </li>

                <li>
                    <div tabindex="0" title="Ligar auto contraste" role="button" aria-pressed="false"
                         class="c__acessible-button c__trasition-300">
                        <div class="c__contrast-button c__contrast-button-light"></div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</header>