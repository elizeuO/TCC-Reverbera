<div class="form-row">
    <div class="form-group col-md-6">
        <label for="model">Modelo</label>
        <input id="model" type="text" class="form-control" name="product[model]" value="<?= $product->getModel() ?>">
    </div>

    <div class="form-group col-md-6">
        <label for="price">Preço</label>
        <input id="price" type="text" class="form-control js-money-mask" name="product[price]"
               value="<?= $product->getPrice() ?>">
    </div>

    <div class="form-group col-md-6">
        <label for="instalment_quantity">Quantidade de Parcelas</label>
        <input id="instalment_quantity" type="text" class="form-control js-number-mask"
               name="product[instalment_quantity]" value="<?= $product->getInstalmentQuantity() ?>">
    </div>

    <div class="form-group form-check form-check-inline col-md-12">
        <input type="checkbox" class="form-check-input" name="product[featured]" id="featured"
               value="1" <?= $product->isFeatured() ? 'checked' : '' ?>>
        <label for="featured" class="form-check-label">Definir como destaque</label>
    </div>
</div>