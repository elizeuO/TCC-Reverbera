<div class="form-row">
    <div class="form-group col-lg-6 col-md-12">
        <label for="link">Link</label>
        <input type="url" class="form-control" name="slide[link]" placeholder="https://www.exemplo.com"
               value="<?= $slide->getLink() ?>">
    </div>

    <div class="form-group form-check form-check-inline col-md-12">
        <input type="checkbox" class="form-check-input" name="slide[target]" id="target" value="_blank"
			<?= $slide->checkedTarget( '_blank' ) ?>>
        <label for="target" class="form-check-label">Abrir link em nova aba</label>
    </div>
</div>
