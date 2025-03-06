

<?php
    $option_logo_footer = get_field('option_logo_footer', 'option');
    $option_logo_footer_array = get_custom_thumb($option_logo_footer, 'full');
?>

<div class="floating-phone">
    <span class="phone-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/>
        </svg>
    </span>
    <span class="phone-number">01 59 30 28 35</span>
</div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="<?= get_site_url(); ?>">
                            <img src="<?= $option_logo_footer_array['url']; ?>" class="logo-footer" alt="<?= $option_logo_footer_array['alt']; ?>">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <p>Accès Rapide</p>
                        <?= wp_nav_menu(array(
                            'menu'				=> "menu", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                            'menu_class'		=> "",
                            'container_class'	=> "menu",// (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                        )); ?>
                    </div>
                    <div class="col-sm-3">
                        <p>Liens utiles</p>
                        <?= wp_nav_menu(array(
                            'menu'				=> "footer", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                            'menu_class'		=> "",
                            'container_class'	=> "menu",// (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                        )); ?>
                    </div>
                    <div class="col-sm-3">
                        <?php get_template_part('template-parts/general/bloc-social');?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 center">
                        <div class="copyright">
                            Site Web By <a href="https://crescendo-studio.io/" rel="noopener" target="_blank">Crescendo</a> ©<?= date("Y"); ?> Tous droits reservés
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <?php
        $cookieConsent = $_COOKIE["cookieyes-consent"];

        $searchConsent = strpos($cookieConsent, 'analytics:yes');

        if($searchConsent && get_field('option_ga_code', 'option')):
            echo get_field('option_ga_code', 'option');
        endif;
        ?>




        <?php if(get_field('option_structured_datas', 'option')): ?>
            <?= get_field('option_structured_datas', 'option'); ?>
        <?php endif; ?>

        <?php wp_footer(); ?>
    </body>
</html>