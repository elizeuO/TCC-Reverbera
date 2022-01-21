<div tabindex="0" aria-label="Player de Audiolivro: <?= the_title() ?>" class="c-audio-player" role="application">
    <div class="w-embed">
        <audio>
<!--            gets the audiofile-->
            <source src="<?=wp_get_attachment_url( $attachment_id )?>"type="audio   /mpeg">
        </audio>
    </div>
    <div class="c-audio-player__controls" >
        <div class="l-flex l-flex--center">
            <button title="Reproduzir audiolivro"
                    aria-label="Reproduzir audiolivro"
                    aria-pressed="false" class="c-audio-player__button c__trasition300 js-playbutton w-button">
                <span aria-hidden="true"></span>
            </button>
            <button title="mutar audiolivro" aria-label="Mutar audiolivro"
                    aria-pressed="false"
                    class="c-audio-player__button c-audio-player__button--blue-color-no-border c__trasition300 js-mutebutton w-button">
                <span aria-hidden="true"></span>
            </button>
            <div class="c-audio__control-bar c-audio__control-bar--smaller-no-margin js-volumecontrolbar"
                 aria-valuemin="0" aria-valuenow="100" aria-value-text="volume 100%"
                 aria-label="Controle de volume" role="slider" aria-valuemax="100"
                 id="volumeControlBar" tabindex="0">
                <div class="c-audio__controller js-volumecontroller"></div>
            </div>
            <a href="<?=wp_get_attachment_url( $attachment_id )?>" title="Fazer download do audiolivro" aria-label="Fazer download do audiolivro"
                    target="_blank" class="c-audio-player__button c-audio-player__button--blue-color-no-border c__trasition300 w-button" download>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="c-audio__time-bar">
            <div class="l-flex l-flex--center">
                <div aria-hidden="true" class="c-audio__time js-currenttime">
                    00:00
                </div>
                <div tabindex="0" role="slider" aria-label="Controle de tempo"
                     class="c-audio__control-bar js-timecontrolbar">
                    <div class="c-audio__controller js-timecontroller c-audio__controller--no-size"></div>
                </div>
                <div aria-hidden="true" class="c-audio__time js-duration">00:00</div>
            </div>
        </div>
    </div>
</div>