<div class="form-row">
    <div class="form-group col-md-6">
        <label for="building_area">Área Construida "m²"</label>
        <input type="text" id="building_area" class="form-control" name="property[building_area]"
               value="<?= $property->getBuildingArea() ?>">
    </div>

    <div class="form-group col-md-6">
        <label for="total_area">Área Total "m²"</label>
        <input type="text" id="total_area" class="form-control" name="property[total_area]"
               value="<?= $property->getTotalArea() ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="toilets">Banheiros</label>
        <input type="number" id="toilets" class="form-control" name="property[toilets]"
               value="<?= $property->getToilets() ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="bedrooms">Quartos</label>
        <input type="number" id="bedrooms" class="form-control" name="property[bedrooms]"
               value="<?= $property->getBedrooms() ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="parking_lots">Vagas na Garagem</label>
        <input type="number" id="parking_lots" class="form-control" name="property[parking_lots]"
               value="<?= $property->getParkingLots() ?>">
    </div>

    <div class="form-group col-md-12">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="pool" name="property[pool]"
                   value="1" <?= $property->hasPool() ? 'checked' : '' ?>>
            <label class="form-check-label" for="pool">Piscina</label>
        </div>
    </div>
</div>