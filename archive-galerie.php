<?php
get_header();

// Variables pour la pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Taxonomies à filtrer
$typo_client = isset($_GET['typo_client']) ? $_GET['typo_client'] : '';
$typo_product = isset($_GET['typo_product']) ? $_GET['typo_product'] : '';
$typo_materiaux = isset($_GET['typo_materiaux']) ? $_GET['typo_materiaux'] : '';

// Arguments pour la WP_Query
$args = array(
    'post_type' => 'galerie',
    'posts_per_page' => 20,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
    ),
);

// Ajout des filtres de taxonomie si présents
if ($typo_client) {
    $args['tax_query'][] = array(
        'taxonomy' => 'typo_client',
        'field'    => 'slug',
        'terms'    => $typo_client,
    );
}
if ($typo_product) {
    $args['tax_query'][] = array(
        'taxonomy' => 'typo_product',
        'field'    => 'slug',
        'terms'    => $typo_product,
    );
}
if ($typo_materiaux) {
    $args['tax_query'][] = array(
        'taxonomy' => 'typo_materiaux',
        'field'    => 'slug',
        'terms'    => $typo_materiaux,
    );
}

// La Query WP
$galerie_query = new WP_Query($args);

?>


<div class="container-fluid" id="galerie">
    <div class="row">
        <div class="col-sm-2">
            <?php
            get_template_part('template-parts/filtre', 'galerie');
            ?>
        </div>

        <div class="col-sm-10">
            <div class="row">
                <?php if ($galerie_query->have_posts()) :

                    // Boucle sur les posts
                    while ($galerie_query->have_posts()) : $galerie_query->the_post();
                        // Affichage des articles
                        get_template_part('template-parts/content', 'galerie'); // Modifie ce template si nécessaire
                    endwhile;

                    // Pagination
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('Previous', 'textdomain'),
                        'next_text' => __('Next', 'textdomain'),
                    ));

                else :
                    echo '<p>' . __('Aucune réalisation n’a été trouvée', 'lsd_lang') . '</p>';
                endif;

                wp_reset_postdata();
                ?>
            </div>

        </div>
    </div>
</div>


<?php
get_footer();
?>