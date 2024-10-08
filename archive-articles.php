<?php
get_header();

// Variables pour la pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Arguments pour la WP_Query
$args = array(
    'post_type' => 'articles',
    'posts_per_page' => 20,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
    ),
);


// La Query WP
$galerie_query = new WP_Query($args);

?>

<div class="strate-hero large  " style="color: #ffffff; background: #0e445f; height: 50vh">
    <div class="strate-hero_inner" style="width: calc(100% - 12vw); text-align: center;">
        <h1>Le Blog</h1>
    </div>

</div>


<div class="container-fluid" id="galerie">
    <div class="row">

        <div class="col-sm-10 mx-auto">
            <div class="row">
                <?php if ($galerie_query->have_posts()) :

                    // Boucle sur les posts
                    while ($galerie_query->have_posts()) : $galerie_query->the_post();
                        // Affichage des articles
                        get_template_part('template-parts/content', 'article'); // Modifie ce template si nécessaire
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
            <div class="strate marge" >

            </div>
        </div>
    </div>
</div>


<?php
get_footer();
?>