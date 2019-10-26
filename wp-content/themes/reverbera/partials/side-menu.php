<div data-collapse="medium" data-animation="default" data-duration="400"
     aria-labeledby="categoryMenuTitle"
     tabindex="0" class="c-category-menu c__center w-nav">

    <h2 id="categoryMenuTitle" class="c-category-menu__title c__white-text">
        Categorias de audiolivros
    </h2>
    <nav role="navigation" class="nav-menu w-nav-menu">
        <ul tabindex="0" role="menu" class="c-gategory-menu__list">

<!--            Renders the category list -->
            <?php $categories = get_categories('taxonomy=categorias&post_type=audiolivro');
            foreach ($categories as $category): ?>
                <li class="c-category-menu__link c__trasition300">
                    <a class="c__link c__trasition300 c__link-full-size">
                        <?= $category->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
    </nav>

    <div role="button" tabindex="0" class="c__menu-button w-nav-button">
        <div class="w-icon-nav-menu"></div>
    </div>
</div>
