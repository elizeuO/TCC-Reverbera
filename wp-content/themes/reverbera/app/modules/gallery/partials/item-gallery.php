<article class="c-gallery-item js-gallery-item <?= ! isset( $attachment ) ? 'js-gallery-item-clone c__hidden' : '' ?>">
    <div class="c-gallery-item--image js-gallery-item-image-url"
         style="<?= isset( $attachment ) ? "background: url({$attachment->getUrl()}) no-repeat center center; -webkit-background-size: cover; background-size: cover;" : '' ?>"></div>
    <div class="c-actions l-flex l-flex--center-content l-flex--center-items">
        <a class="c-button js-gallery-item-change">
            <i class="dashicons dashicons-edit"></i>
        </a>
        <a class="c-button js-gallery-item-delete">
            <i class="dashicons dashicons-trash"></i>
        </a>
    </div>
    <input type="hidden" <?= isset( $attachment ) ? "name='{$this->metaKey}[{$index}][id]' value='{$attachment->getID()}'" : '' ?>
           class="js-gallery-item-id">
</article>