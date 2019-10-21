<?php use App\Provider\HelperProvider; ?>

<table class="form-table" id="js-container">
    <tbody>
    <tr class="form-field term-slug-wrap">
        <th scope="row">
            <label>Imagem destacada</label>
        </th>
        <td class="js-item-attachment">
            <div style="width: 200px" class="js-attachment-img">
				<?php
				$thumbnail = HelperProvider::getImageUrlById( $itemTerm->getThumbnailID() );

				if ( ! empty( $thumbnail ) ) {
					echo "<img src='{$thumbnail}' style='width: 100%; margin-bottom: 15px;'>";
				} ?>
            </div>
            <input name="thumbnail_id" class="js-attachment-id" type="hidden"
                   value="<?= $itemTerm->getThumbnailID() ?>">
            <button type="button" class="button button-secondary js-add-attachment">Adicionar</button>
            <button type="button" class="button button-cancel js-remove-attachment"
				<?= ! empty( $thumbnail ) ? '' : 'style="display: none"' ?>>Remover
            </button>
        </td>
    </tr>
	<?php if ( $this->hasIcon ) { ?>
        <tr class="form-field term-slug-wrap">
            <th scope="row">
                <label>Ícone</label>
            </th>
            <td class="js-item-attachment">
                <div style="width: 200px" class="js-attachment-img">
					<?php
					$icon = HelperProvider::getImageUrlById( $itemTerm->getIconID() );

					if ( ! empty( $icon ) ) {
						echo "<img src='{$icon}' style='width: 100%; margin-bottom: 15px;'>";
					} ?>
                </div>
                <input name="icon_id" class="js-attachment-id" type="hidden"
                       value="<?= $itemTerm->getIconID() ?>">
                <button type="button" class="button button-secondary js-add-attachment">Adicionar</button>
                <button type="button" class="button button-cancel js-remove-attachment"
					<?= ! empty( $icon ) ? '' : 'style="display: none"' ?>>Remover
                </button>
            </td>
        </tr>
	<?php } ?>
    </tbody>
</table>