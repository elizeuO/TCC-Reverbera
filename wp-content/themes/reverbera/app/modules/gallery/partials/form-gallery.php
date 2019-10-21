<?php $imagePath = $this->modulePath . '/assets/images/'; ?>

<div class="js-gallery" data-meta-key="<?= $this->metaKey ?>" id="<?= $this->id ?>">
    <div class="js-gallery-icon"
         data-icon-pdf="<?= $imagePath . 'pdf.png' ?>"
         data-icon-zip="<?= $imagePath . 'zip.png' ?>"
         data-icon-ppt="<?= $imagePath . 'ppt.png' ?>"
         data-icon-xls="<?= $imagePath . 'xls.png' ?>"
         data-icon-default="<?= $imagePath . 'file.png' ?>"
         data-icon-doc="<?= $imagePath . 'doc.png' ?>"></div>

    <div class="c-gallery l-flex js-gallery-container">
		<?php $this->renderAttachments( $imagePath ); ?>
    </div>

    <button type="button" class="button button-secondary js-add-gallery-items" data-id="<?= $this->id ?>">
        Adicionar
    </button>

	<?php include "item-gallery.php"; ?>
</div>

