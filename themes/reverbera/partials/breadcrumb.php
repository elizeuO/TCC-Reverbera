<div class="c-breadcrumb">
    <div class="c__center">
        <div class="c-bread-crumb__description">
            <?= !is_home() ? 'Você está aqui:' : '' ?>
        </div>
        <?php if (!is_home()) { ?>
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        <?php } ?>
    </div>
</div>