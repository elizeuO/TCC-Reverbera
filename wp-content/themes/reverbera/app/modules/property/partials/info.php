<?php use App\Provider\HelperProvider; ?>

<div class="form row">
    <div class="form-group col-md-4">
        <label for="code">Código</label>
        <input type="text" class="form-control" name="property[code]" value="<?= $property->getCode() ?>" id="code">
    </div>

    <div class="form-group col-md-4">
        <label for="price">Preço</label>
        <input type="text" class="form-control js-money-mask" name="property[price]" id="price"
               value="<?= $property->getPrice() ?>">
        <span class="c__info">Para "Sob Consulta" deixar em branco</span>
    </div>

    <div class="form-group col-md-4">
        <label for="ad_type">Anunciar como</label>
        <select name="property[ad_type]" id="ad_type" class="form-control">
            <option <?= selected( 'rent', $property->getAdType() ) ?> value="rent">Aluguel</option>
            <option <?= selected( 'sale', $property->getAdType() ) ?> value="sale">Venda</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="type">Tipo</label>
        <input type="text" class="form-control" name="property[type]" id="type" placeholder="ex: Casa térrea Grande"
               value="<?= $property->getType() ?>">
    </div>

    <div class="form-group col-md-6">
        <label for="address">Endereço</label>
        <input type="text" class="form-control" name="property[address]" id="address"
               value="<?= $property->getAddress() ?>">
    </div>

    <div class="form-group col-md-4">
		<?php $neighborhood = $this::getMetaValues( 'neighborhood', $this->postType ); ?>
        <label for="neighborhood">Bairro</label>
        <input type="text" class="form-control js-autocomplete" name="property[neighborhood]" id="neighborhood"
               autocomplete="off" value="<?= $property->getNeighborhood() ?>"
               data-value='<?= json_encode( $neighborhood, JSON_UNESCAPED_UNICODE ) ?>'>
    </div>

    <div class="form-group col-md-4">
		<?php $cities = $this::getMetaValues( 'city', $this->postType ); ?>
        <label for="city">Cidade</label>
        <input type="text" class="form-control js-autocomplete" name="property[city]" id="city" autocomplete="off"
               value="<?= $property->getCity() ?>" data-value='<?= json_encode( $cities, JSON_UNESCAPED_UNICODE ) ?>'>
    </div>

    <div class="form-group col-md-4">
        <label for="state">Estado</label>
        <select name="property[state]" id="state" class="form-control">
            <option value="">Selecione...</option>
            <option <?= selected( 'AC', $property->getState() ) ?> value="AC">Acre</option>
            <option <?= selected( 'AL', $property->getState() ) ?> value="AL">Alagoas</option>
            <option <?= selected( 'AP', $property->getState() ) ?> value="AP">Amapá</option>
            <option <?= selected( 'AM', $property->getState() ) ?> value="AM">Amazonas</option>
            <option <?= selected( 'BA', $property->getState() ) ?> value="BA">Bahia</option>
            <option <?= selected( 'CE', $property->getState() ) ?> value="CE">Ceará</option>
            <option <?= selected( 'DF', $property->getState() ) ?> value="DF">Distrito Federal</option>
            <option <?= selected( 'ES', $property->getState() ) ?> value="ES">Espírito Santo</option>
            <option <?= selected( 'GO', $property->getState() ) ?> value="GO">Goiás</option>
            <option <?= selected( 'MA', $property->getState() ) ?> value="MA">Maranhão</option>
            <option <?= selected( 'MT', $property->getState() ) ?> value="MT">Mato Grosso</option>
            <option <?= selected( 'MS', $property->getState() ) ?> value="MS">Mato Grosso do Sul</option>
            <option <?= selected( 'MG', $property->getState() ) ?> value="MG">Minas Gerais</option>
            <option <?= selected( 'PA', $property->getState() ) ?> value="PA">Pará</option>
            <option <?= selected( 'PB', $property->getState() ) ?> value="PB">Paraíba</option>
            <option <?= selected( 'PR', $property->getState() ) ?> value="PR">Paraná</option>
            <option <?= selected( 'PE', $property->getState() ) ?> value="PE">Pernambuco</option>
            <option <?= selected( 'PI', $property->getState() ) ?> value="PI">Piauí</option>
            <option <?= selected( 'RJ', $property->getState() ) ?> value="RJ">Rio de Janeiro</option>
            <option <?= selected( 'RN', $property->getState() ) ?> value="RN">Rio Grande do Norte</option>
            <option <?= selected( 'RS', $property->getState() ) ?> value="RS">Rio Grande do Sul</option>
            <option <?= selected( 'RO', $property->getState() ) ?> value="RO">Rondônia</option>
            <option <?= selected( 'RR', $property->getState() ) ?> value="RR">Roraima</option>
            <option <?= selected( 'SC', $property->getState() ) ?> value="SC">Santa Catarina</option>
            <option <?= selected( 'SP', $property->getState() ) ?> value="SP">São Paulo</option>
            <option <?= selected( 'SE', $property->getState() ) ?> value="SE">Sergipe</option>
            <option <?= selected( 'TO', $property->getState() ) ?> value="TO">Tocantins</option>
        </select>
    </div>

    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <textarea name="property[description]" class="form-control" id="description" cols="30"
                  rows="5"><?= $property->getDescription() ?></textarea>
    </div>

    <div class="form-group col-md-12">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="featured" name="property[featured]"
                   value="1" <?= $property->isFeatured() ? 'checked' : '' ?>>
            <label class="form-check-label" for="featured">Destaque</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="release" name="property[release]"
                   value="1" <?= $property->isRelease() ? 'checked' : '' ?>>
            <label class="form-check-label" for="release">Lançamento</label>
        </div>
    </div>

</div>