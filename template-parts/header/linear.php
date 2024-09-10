<?php
    $menu = get_field('menu_items', 'option');
?>

<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1">
                <div class="logo">
                    <a href="<?= get_site_url(); ?>">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/styles/img/logo.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="burger-menu">
                    <div class="barre"></div>
                    <div class="barre"></div>
                    <div class="barre"></div>
                </div>
                <ul class="main-menu">
                    <?php
                    foreach ($menu as $menu_item):
                        $pageId = $menu_item['menu_items_primary'];
                        $haveSub = $menu_item['menu_items_sub'];
                        $subMenu = $menu_item['menu_items_secondary'];
                        $imageSubMenu = $menu_item['menu_secondary_image'];
                        $imageSubMenuUrl = '';
                        if($imageSubMenu){
                            $imageSubMenuUrl = get_custom_thumb($imageSubMenu, 'large');
                        }

                        $title = get_the_title($pageId);
                        $link = get_the_permalink($pageId);
                        ?>

                        <li>
                            <a href="<?= $link; ?>"><?= $title; ?></a>
                            <?php if($haveSub && $subMenu): ?>
                                <div class="arrow-sub"></div>
                                <ul class="submenu">
                                    <?php if(isset($imageSubMenuUrl['url']) && $imageSubMenuUrl['url']): ?>
                                        <div class="image">
                                            <img src="<?= $imageSubMenuUrl['url']; ?>" class="img" alt="">
                                        </div>
                                    <?php endif; ?>

                                    <div class="links">
                                        <li class="intro-link">
                                            <a href="<?= $link; ?>"><?= $title; ?></a>
                                        </li>
                                        <?php
                                        foreach ($subMenu as $subMenuItem):
                                            $title = get_the_title($subMenuItem);
                                            $link = get_the_permalink($subMenuItem);
                                            ?>
                                            <li class="link-sub">
                                                <a href="<?= $link; ?>">
                                                    <?= $title; ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </div>
                                </ul>
                            <?php endif; ?>
                        </li>

                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <a href="" class="button">Demander un devis</a>
            </div>

        </div>
    </div>

</div>

