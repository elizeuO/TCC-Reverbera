<div id="js-container">
    <div class="form-field term-slug-wrap js-item-attachment">
        <label for="attachment_id">Imagem destacada</label>
        <div style="width: 200px" class="js-attachment-img"></div>
        <input name="thumbnail_id" id="attachment_id" class="js-attachment-id" type="hidden" value="">
        <button type="button" class="button button-secondary js-add-attachment">Adicionar</button>
        <button type="button" style="display: none" class="button button-cancel js-remove-attachment">Remover</button>
    </div>
	<?php if ( $this->hasIcon ) { ?>
        <div class="form-field term-slug-wrap js-item-attachment">
            <label for="icon_id">Ícone</label>
            <div style="width: 200px" class="js-attachment-img"></div>
            <input name="icon_id" id="icon_id" class="js-attachment-id" type="hidden" value="">
            <button type="button" class="button button-secondary js-add-attachment">Adicionar</button>
            <button type="button" style="display: none" class="button button-cancel js-remove-attachment">Remover
            </button>
        </div>
	<?php } ?>
</div>
