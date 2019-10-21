<div class="jsImage">
    <input type="hidden" name="<?= $this->metaOptions['key'] ?>" class="jsImageID" value="<?= $this->attachmentID ?>">

    <img src="<?= $this->attachmentUrl ?>" style="max-width: 100%;" class="c_image jsImageUrl">

    <p class="c_image__info jsImageInfo <?= ! empty( $this->attachmentUrl ) ? '' : 'c_hidden' ?>">
        Clique na imagem para alterar
    </p>

    <a href="#" class="jsImageButton">
		<?= ! empty( $this->attachmentUrl ) ? 'Remover' : 'Adicionar' ?> Imagem
    </a>
</div>
