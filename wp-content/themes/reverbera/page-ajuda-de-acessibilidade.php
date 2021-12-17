<?php include('partials/header.php'); ?>

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

                    <?php include('partials/breadcrumb.php') ?>

                    <p class="c__paragraph">
                        O site Reverbera foi desenvolvido para atender as necessidades do público Deficiente Visual,
                        seguindo as recomendações do WCAG 2.0 (Web Content Accessibility Guidelines), do W3C (World Wide
                        Web
                        Consortium), principal organização de padronização da Web, que desenvolve especificações
                        técnicas e
                        orientações de uso internacional.
                        Para tal, foram implementados para garantir este acesso, opções
                        como o alto contraste, possibilidade de aumento de fonte, teclas de atalho e navegação por
                        teclado.
                    </p>

                    <h2 class="c__title c__center">
                        Como Usar:
                    </h2>

                    <p class="c__paragraph">
                        Para aumentar a fonte, é só clicar no símbolo de A+ em nossa barra de acessibilidade e para
                        diminuir
                        clique no símbolo de A-.<br>
                        Utilize a opção de contraste para alternar para o modo de alto contraste ou desligar.
                    </p>

                    <h3 class="c__title c__center">
                        Teclas de atalho por navegadores:
                    </h3>

                    <b>
                        Microsoft Edge e Google Chrome:
                    </b>

                    <ul>

                        <li>
                            Alt + 1 - ir para o conteúdo
                        </li>

                        <li>
                            Alt + 2 - ir para o menu
                        </li>

                        <li>
                            Alt + 3 - ir para a página de acessibilidade
                        </li>

                    </ul>
                    <br>

                    <b>
                        Firefox:
                    </b>

                    <ul>
                        <li>
                            Alt + Shift 1 - ir para o conteúdo
                        </li>

                        <li>
                            Alt + Shift 2 - ir para o menu
                        </li>

                        <li>
                            Alt + Shift 3 - ir para a página de acessibilidade
                        </li>
                    </ul>

                    <br>

                    <b>
                        Opera:
                    </b>

                    <ul>
                        <li>
                            Shift + Escape + 1 - ir para o conteúdo
                        </li>

                        <li>
                            Shift + Escape + 2 - ir para o menu
                        </li>

                        <li>
                            Shift + Escape + 3 - ir para a página de acessibilidade
                        </li>
                    </ul>

                    <br>

                    <b>
                        Safari e OmniWeb:
                    </b>

                    <ul>
                        <li>
                            CTRL + 1 - ir para o conteúdo
                        </li>

                        <li>
                            CTRL + 2 - ir para o menu
                        </li>

                        <li>
                            CTRL + 3 - ir para a página de acessibilidade
                        </li>
                    </ul>

                    <br>

                    <h3 class="c__title c__center">
                        Navegação por tabulação
                    </h3>

                    <p class="c__paragraph">
                        Use a tecla Tab para navegar por todo o conteúdo operável das páginas e Shift + Tab
                        para retornar.
                    </p>

                    <h3 class="c__title c__center">
                        O Audioplayer
                    </h3>

                    <p class="c__paragraph">
                        O audioplayer foi desenvolvido para que o usuário tenha controle dos recursos de áudio de forma
                        que consiga saber o tempo atual da repodução e grau da faixa de reprodução (tais informações
                        apresentam problemas em alguns dispositivos mobile), para facilitar o entendimento da mensagem
                        nos leitores de tela, ao se mudar o foco de um controle para outro o áudio será pausado em
                        alguns segundos.

                    </p>

                    <h4 class="c__title c__center">
                        Controles do audioplayer
                    </h4>

                    <p class="c__paragraph">
                        <b>Tecla Home: </b> Na barra de tempo de áudio, retorna para o início da reprodução. Na barra de
                        volume, o reduz para 0.
                        <br>
                        <b>Tecla End: </b> Na barra de tempo de áudio, avança para o final da reprodução. Na barra de
                        volume, aumenta o volume do áudio no máximo.
                        <br>
                        <b>Tecla direcional para cima ou para direita: </b> Na barra de tempo de áudio, avança o tempo
                        da reprodução. Na barra de volume, aumenta o volume do áudio gradualmente.
                        <br>
                        <b>Tecla direcional para baixo ou para esquerda: </b> Na barra de tempo de áudio, retrocede o
                        tempo da reprodução. Na barra de volume, diminui o volume do áudio gradualmente.
                    </p>

                    <h3 class="c__title c__center">
                        Sugestões de leitores de tela
                    </h3>

                    <p class="c__paragraph">
                        Leitores de tela são recomendados para usuários com deficiência visual, através desta tecnologia
                        assistiva este público pode acessar todo o conteúdo do site de forma integral.
                        Confira a lista de leitores de tela recomendados:
                    </p>

                    <ul>
                        <li>
                            <b>ChromeVox:</b> extensão de leitor de tela para o navegador Google Chrome;
                        </li>

                        <li>
                            <b>NVDA:</b> software livre para ler tela (pago) – vários idiomas (Windows);
                        </li>

                        <li>
                            <b>YeoSoft Text:</b> leitor de tela em inglês e português;
                        </li>

                        <li>
                            <b>Jaws for Windows:</b> leitor de tela – vários idiomas;
                        </li>

                        <li>
                            <b>Virtual Vision:</b> leitor de telas em português do Brasil;
                        </li>

                        <li>
                            <b>DOSVOX</b> sistema para deficientes visuais (Windows ou Linux).
                        <li>

                        <li>
                            <b>Orca</b> leitor de tela gratuito para Linux
                        <li>

                        <li>
                            <b>VoiceOver</b> Leitor de tela para IOS que acompanha os dispositivos da Apple.
                        <li>
                    </ul>
                    <br>
                    Observação: leia no manual do leitor de telas sobre a melhor forma de navegação em páginas web.

                </main>
            </div>
        </div>
    </section>
<?php include('partials/footer.php'); ?>