<?php
//Gets the id of the audiobook in the database
$attachment_id = get_field('audioFile');

$metadata = wp_get_attachment_metadata($attachment_id);
$size = $metadata['filesize'];
?>
<li class="l__col-4">
    <article class="c-audiobook">
        <a href="<?= the_permalink() ?>" class="c-audiobook__link c__trasition300 w-inline-block">
            <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= the_field('coverAlt') ?>">
            <div class="c-audiobook__info-box">
                <h3 class="c-audiobook__title">
                 <span class="c__accessible-text">
                   Título:
                  </span>
                    <?= the_title() ?>
                </h3>
                <div class="c-audiobook__info">
                    <span class="c__bold">
                     Autor:
                     </span>
                    João Marques de Carvalho
                </div>
                <div class="c-audiobook__info">
                  <span class="c__bold">
                      Tamanho:
                   </span>
                    <?=
                    //changes the format of the size data
                    size_format($size, 0);
                    ?>
                </div>
            </div>
        </a>
        <?php include('audioplayer.php') ?>
    </article>
</li>