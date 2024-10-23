<?php
    $menu = get_field('menu_items', 'option');
?>

<div class="loader">
    <svg width="267" height="341" viewBox="0 0 267 341" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M212.786 26.417V151.784H181.916V0H254.069V26.417H212.786Z" fill="#224761"/>
        <path d="M171.256 0H114.867V26.417H171.256V0Z" fill="#224761"/>
        <path d="M117.881 277.062C117.881 297.673 112.86 313.1 102.775 323.343C90.9215 334.872 76.0629 340.595 58.1585 340.595C41.283 340.595 27.083 335.079 15.5583 323.965C8.72583 317.454 4.44524 309.824 2.67538 301.156C0.905517 292.613 0 280.048 0 263.418C0 246.788 0.905517 234.222 2.67538 225.679C4.44524 217.012 8.72583 209.423 15.5583 202.87C27.083 191.797 41.283 186.24 58.1585 186.24C75.0339 186.24 89.0693 191.009 99.8943 200.548C109.526 209.215 115.453 220.661 117.675 234.886H86.5998C82.7719 220.081 73.3052 212.699 58.1996 212.699C49.9266 212.699 43.341 215.394 38.443 220.786C35.3561 224.476 33.3393 228.665 32.4337 233.351C31.4047 239.033 30.8697 249.069 30.8697 263.418C30.8697 277.767 31.4047 288.093 32.4337 293.484C33.3393 298.461 35.3149 302.732 38.443 306.257C43.0117 311.524 49.5973 314.137 58.1996 314.137C67.3782 314.137 74.7047 311.317 80.1789 305.594C84.9122 300.327 87.2583 293.567 87.2583 285.356V279.591H58.1996V254.875H117.881V277.062Z" fill="#224761"/>
        <path d="M73.3025 44.7471L43.9145 124.288H102.937L73.3025 44.7471ZM3.57812 151.784L61.0369 0H85.2387L142.944 151.784H3.57812Z" fill="#224761"/>
        <path d="M196.908 232.271L167.52 311.812H226.543L196.908 232.271ZM127.184 339.307L184.642 187.523H208.844L266.55 339.307H127.184Z" fill="#224761"/>
    </svg>

</div>
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
                                            <img src="<?= $imageSubMenuUrl['url']; ?>" width="<?= $imageSubMenuUrl['width']; ?>" height="<?= $imageSubMenuUrl['height']; ?>" class="img" alt="<?= $imageSubMenuUrl['alt']; ?>" loading="lazy">
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
                    <li>
                        <a href="<?= get_site_url(); ?>/galerie/">
                            Galerie
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <a href="<?= get_site_url(); ?>/demande-de-devis/" class="button">Demander un devis</a>
            </div>
        </div>
    </div>
</div>

<?php custom_breadcrumb(); ?>
