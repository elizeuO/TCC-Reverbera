<article class="col-md-12 c__item-form">
    <div>
        <h4 class="c__title"><?= $form['title'] ?></h4>
    </div>
    <input type="hidden" name="forms[<?= $key ?>][id]" value="<?= $form['name'] ?>">
    <input type="text" name="forms[<?= $key ?>][emails]" value="<?= get_option( $form['name'] ) ?>" class="form-control"
           placeholder="exemplo@exemplo.com">
</article>