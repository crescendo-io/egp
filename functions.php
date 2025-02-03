<?php


function add_hreflang_tags() {
    // Définir l'URL de la version par défaut (x-default) du site
    $default_url = get_home_url(); // ou mettre une URL spécifique

    // Obtenir l'URL actuelle
    $current_url = home_url( add_query_arg( NULL, NULL ) );

    // Si la langue est française
    if ( get_locale() == 'fr_FR' ) {
        echo '<link rel="alternate" hreflang="fr" href="' . esc_url( $current_url ) . '" />' . "\n";
    }

    // Pour la version x-default
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $default_url ) . '" />' . "\n";
}
add_action( 'wp_head', 'add_hreflang_tags' );


function add_self_canonical_tag() {
    // Obtenir l'URL de la page actuelle
    $current_url = home_url( add_query_arg( NULL, NULL ) );

    // Ajouter la balise canonical
    echo '<link rel="canonical" href="' . esc_url( $current_url ) . '" />' . "\n";
}
add_action( 'wp_head', 'add_self_canonical_tag' );

add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );
function wpm_enqueue_styles(){
    //wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/styles/theme.css' );
    wp_enqueue_style('lightbox', get_stylesheet_directory_uri() . '/styles/lightbox.css', array(), filemtime(get_template_directory() . '/styles/theme.css'));
    wp_enqueue_style('theme', get_stylesheet_directory_uri() . '/styles/theme.css', array(), filemtime(get_template_directory() . '/styles/theme.css'));
    wp_enqueue_script(
        'lightbox', // Identifiant unique du script
        get_stylesheet_directory_uri() . '/js/lightbox.min.js', // URL du fichier JS
        array( 'jquery' ), // Dépendances (si besoin, ici 'jquery')
        null, // Version du script (null pour désactiver la gestion des versions)
        true // Charger dans le footer (true) ou dans le header (false)
    );

    wp_enqueue_script(
        'script', // Identifiant unique du script
        get_stylesheet_directory_uri() . '/js/script.js', // URL du fichier JS
        array( 'jquery' ), // Dépendances (si besoin, ici 'jquery')
        null, // Version du script (null pour désactiver la gestion des versions)
        true // Charger dans le footer (true) ou dans le header (false)
    );
}


function egp_custom_post_type() {
    $labels = array(
        'name'                => __( 'Galerie', 'lsd_lang'),
        'singular_name'       => __( 'Galerie', 'lsd_lang'),
        'menu_name'           => __( 'Galerie', 'lsd_lang'),
        'all_items'           => __( 'Tous les types de Galerie', 'lsd_lang'),
        'view_item'           => __( 'Voir tous les types de Galerie', 'lsd_lang'),
        'add_new_item'        => __( 'Ajouter une Galerie', 'lsd_lang'),
        'add_new'             => __( 'Ajouter', 'lsd_lang'),
        'edit_item'           => __( 'Editer un type la Galerie', 'lsd_lang'),
        'update_item'         => __( 'Modifier un type la galerie', 'lsd_lang'),
        'not_found'           => __( 'Non trouvée', 'lsd_lang'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille', 'lsd_lang'),
    );

    $args = array(
        'label'               => __( 'Types de Galerie', 'lsd_lang'),
        'description'         => __( 'Toutes les Galerie', 'lsd_lang'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'author', 'revisions', 'custom-fields' ),
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-admin-home',
        'hierarchical'        => true,
        'public'              => true,
        'publicly_queryable' => true,
        'has_archive'         => 'galerie',
        'rewrite' => array(
            'with_front' => true
        )
    );

    register_post_type( 'galerie', $args );

    // Product

    $labels = array(
        'name'                => __( 'Produits', 'lsd_lang'),
        'singular_name'       => __( 'Produits', 'lsd_lang'),
        'menu_name'           => __( 'Produits', 'lsd_lang'),
        'all_items'           => __( 'Tous les types de Produits', 'lsd_lang'),
        'view_item'           => __( 'Voir tous les types de Produits', 'lsd_lang'),
        'add_new_item'        => __( 'Ajouter un Produit', 'lsd_lang'),
        'add_new'             => __( 'Ajouter', 'lsd_lang'),
        'edit_item'           => __( 'Editer un type la Produit', 'lsd_lang'),
        'update_item'         => __( 'Modifier un type la Produit', 'lsd_lang'),
        'not_found'           => __( 'Non trouvée', 'lsd_lang'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille', 'lsd_lang'),
    );

    $args = array(
        'label'               => __( 'Produit', 'lsd_lang'),
        'description'         => __( 'Produits', 'lsd_lang'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'author', 'revisions', 'custom-fields', 'page-attributes'),
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-admin-home',
        'hierarchical'        => true,
        'public'              => true,
        'publicly_queryable' => true,
        'has_archive'         => false,
        'rewrite' => array(
            'with_front' => true
        )
    );

    //register_post_type( 'product', $args );


    $labels = array(
        'name'                => __( 'Articles', 'lsd_lang'),
        'singular_name'       => __( 'Article', 'lsd_lang'),
        'menu_name'           => __( 'Articles', 'lsd_lang'),
        'all_items'           => __( 'Tous les types de Articles', 'lsd_lang'),
        'view_item'           => __( 'Voir tous les types de Articles', 'lsd_lang'),
        'add_new_item'        => __( 'Ajouter un Article', 'lsd_lang'),
        'add_new'             => __( 'Ajouter', 'lsd_lang'),
        'edit_item'           => __( 'Editer un type la Article', 'lsd_lang'),
        'update_item'         => __( 'Modifier un type la Article', 'lsd_lang'),
        'not_found'           => __( 'Non trouvée', 'lsd_lang'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille', 'lsd_lang'),
    );

    $args = array(
        'label'               => __( 'Article', 'lsd_lang'),
        'description'         => __( 'Article', 'lsd_lang'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'author', 'revisions', 'custom-fields', 'thumbnail'),
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-admin-home',
        'hierarchical'        => true,
        'public'              => true,
        'publicly_queryable' => true,
        'has_archive'         => true,
        'rewrite' => array(
            'with_front' => true,
        )
    );

    register_post_type( 'articles', $args );

}

add_action( 'init', 'egp_custom_post_type', 0 );


function disable_rss_for_cpt() {
    if (is_feed()) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'disable_rss_for_cpt');

function disable_search_redirect() {
    if (is_search() && !is_admin()) {
        wp_redirect(home_url()); // Redirige vers la page d'accueil
        exit;
    }
}
add_action('template_redirect', 'disable_search_redirect');


function desactiver_single_cpt() {
    if (is_singular('galerie')) {
        wp_redirect(home_url());  // Redirige vers la page d'accueil ou une autre page de ton choix.
        exit;
    }
}
add_action('template_redirect', 'desactiver_single_cpt');



function egp_taxonomy() {
    register_taxonomy(
        'typo_client',
        'galerie',
        array(
            'hierarchical' => true,
            'show_admin_column' => true,
            'label' => __( 'Typologie de client', 'lsd_lang'),
            'query_var' => true
        )
    );

    register_taxonomy(
        'typo_product',
        'galerie',
        array(
            'hierarchical' => true,
            'show_admin_column' => true,
            'label' => __( 'Typologie de produit', 'lsd_lang'),
            'query_var' => true
        )
    );

    register_taxonomy(
        'typo_materiaux',
        'galerie',
        array(
            'hierarchical' => true,
            'show_admin_column' => true,
            'label' => __( 'Typologie de matériaux', 'lsd_lang'),
            'query_var' => true
        )
    );

}
add_action( 'init', 'egp_taxonomy');

function redirect_single_terms() {
    if (is_tax('typo_client') || is_tax('typo_product') || is_tax('typo_materiaux') || is_category()) {
        if(!is_archive()){
            wp_redirect(home_url());
            exit;
        }
    }
}

add_action('template_redirect', 'redirect_single_terms');


add_image_size('600_600', 600, 600, true);


// Hide native post type
function hide_post_type_from_admin_menu() {
    // Pour masquer les articles (post)
    remove_menu_page('edit.php');
    // Pour masquer les pages
    // remove_menu_page('edit.php?post_type=page');
}
add_action('admin_menu', 'hide_post_type_from_admin_menu');

function hide_post_type_from_frontend($args, $post_type) {
    if ($post_type === 'post') {  // Remplacez 'post' par le post type que vous voulez masquer
        $args['public'] = false;  // Rend le post type privé
        $args['publicly_queryable'] = false;  // Empêche les requêtes sur le front-end
        $args['show_ui'] = false;  // Masque du menu d'administration
        $args['exclude_from_search'] = true;  // Exclut des résultats de recherche
    }
    return $args;
}
add_filter('register_post_type_args', 'hide_post_type_from_frontend', 10, 2);


function migrate_products_to_pages() {
    // Vérifier que la fonction ACF existe
    if ( ! function_exists('get_field') || ! function_exists('update_field') ) {
        return;
    }

    // Récupérer tous les posts de type "product" y compris les brouillons
    $products = new WP_Query( array(
        'post_type' => 'product',
        'posts_per_page' => -1, // Pour tout récupérer
        'post_status' => array('publish', 'draft') // Inclure les brouillons
    ) );

    // Tableau pour stocker les ID des pages créées
    $created_pages = array();

    if ( $products->have_posts() ) {
        while ( $products->have_posts() ) {
            $products->the_post();

            // Récupérer l'ID du produit et son titre
            $product_id = get_the_ID();
            $product_title = get_the_title( $product_id );

            // Vérifier si la page existe déjà
            $existing_page_query = new WP_Query( array(
                'post_type' => 'page',
                'title'     => $product_title,
                'posts_per_page' => 1
            ) );

            if ( $existing_page_query->have_posts() ) {
                // Ajouter un message dans le log si la page existe déjà
                error_log( "La page pour le produit ID: $product_id existe déjà" );
                continue; // Passer au produit suivant
            }

            // Récupérer les champs ACF du produit
            $acf_fields = get_fields( $product_id );

            // Créer une nouvelle page avec le template "Page Produit"
            $new_page_id = wp_insert_post( array(
                'post_title'   => $product_title,
                'post_content' => get_the_content( $product_id ),
                'post_status'  => 'publish', // Mettre en statut 'publish' pour toutes les nouvelles pages
                'post_type'    => 'page',
                'page_template' => 'page-product.php', // Assurez-vous que le template est correct
            ) );

            // Vérifier si la page a bien été créée
            if ( $new_page_id && ! is_wp_error( $new_page_id ) ) {
                // Réassigner les champs ACF à la nouvelle page
                if ( $acf_fields ) {
                    foreach ( $acf_fields as $field_key => $field_value ) {
                        update_field( $field_key, $field_value, $new_page_id );
                    }
                }

                // Ajouter l'ID de la page créée au tableau
                $created_pages[$product_id] = $new_page_id;

                // Ajouter un message dans le log pour chaque page créée
                error_log( "Page créée pour le produit ID: $product_id avec la nouvelle page ID: $new_page_id" );
            } else {
                // Ajouter un message d'erreur dans le log
                error_log( "Erreur lors de la création de la page pour le produit ID: $product_id" );
            }
        }
        // Remettre la requête principale
        wp_reset_postdata();

        // Réaffecter les pages enfants
        foreach ( $created_pages as $product_id => $new_page_id ) {
            // Récupérer l'ID de la page parent (si elle existe)
            $parent_id = get_post_meta( $product_id, '_product_parent_page', true );

            if ( $parent_id && isset( $created_pages[$parent_id] ) ) {
                // Définir la page créée comme enfant de la page parent
                wp_update_post( array(
                    'ID' => $new_page_id,
                    'post_parent' => $created_pages[$parent_id]
                ) );
            }
        }
    } else {
        // Ajouter un message dans le log si aucun produit trouvé
        error_log( "Aucun produit trouvé pour migration" );
    }
}
//add_action( 'init', 'migrate_products_to_pages' );



// Fil d'ariane

function custom_breadcrumb() {
    // Start the breadcrumb with a link to the home page
    if (!is_front_page()) {
        echo '<nav class="breadcrumb">';
        echo '<a href="' . home_url() . '">Accueil</a> ';

        // If we're on a single post, custom post type or page
        if (is_singular()) {
            global $post;
            $post_type = get_post_type_object(get_post_type());

            // If the post type is not 'post', show the post type archive link
            if ($post_type && $post_type->has_archive) {
                echo '<a href="' . get_post_type_archive_link($post_type->name) . '">' . $post_type->labels->name . '</a> ';
            }

            // Get ancestors of the current post to show hierarchy
            $ancestors = array_reverse(get_post_ancestors($post));

            foreach ($ancestors as $ancestor) {
                echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a> ';
            }

            // Finally, the current post title
            echo '<span>' . get_the_title() . '</span>';
        }
        // If we're on a post type archive page
        elseif (is_post_type_archive()) {
            $post_type = get_post_type_object(get_post_type());
            if ($post_type) {
                echo '<span>' . $post_type->labels->name . '</span>';
            }
        }
        // If we're on a category or custom taxonomy archive page
        elseif (is_category() || is_tag() || is_tax()) {
            $term = get_queried_object();
            echo '<span>' . $term->name . '</span>';
        }
        // If we're on an archive page like date, author, etc.
        elseif (is_archive()) {
            if (is_date()) {
                if (is_day()) {
                    echo '<span>' . get_the_date() . '</span>';
                } elseif (is_month()) {
                    echo '<span>' . get_the_date('F Y') . '</span>';
                } elseif (is_year()) {
                    echo '<span>' . get_the_date('Y') . '</span>';
                }
            } elseif (is_author()) {
                echo '<span>' . get_the_author() . '</span>';
            }
        }
        // For 404 pages
        elseif (is_404()) {
            echo '<span>Erreur 404</span>';
        }
    }

    // Close nav tag
    echo '</nav>';
}


function add_opportunity() {

    // POST
    $societyName    = isset($_POST['society-name']) ? sanitize_text_field(wp_strip_all_tags($_POST['society-name'])) : '';
    $societyAddress = isset($_POST['society-address']) ? sanitize_text_field(wp_strip_all_tags($_POST['society-address'])) : '';
    $projectAddress = isset($_POST['project-address']) ? sanitize_text_field(wp_strip_all_tags($_POST['project-address'])) : '';
    $firstName      = isset($_POST['first-name']) ? sanitize_text_field(wp_strip_all_tags($_POST['first-name'])) : '';
    $secondName     = isset($_POST['second-name']) ? sanitize_text_field(wp_strip_all_tags($_POST['second-name'])) : '';
    $ProjectInfo     = isset($_POST['description']) ? sanitize_text_field(wp_strip_all_tags($_POST['description'])) : '';
    $email          = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone          = isset($_POST['phone']) ? preg_replace('/[^0-9+]/', '', $_POST['phone']) : '';


    $descriptionProject = '<strong>Information du projet : </strong><br/>' . $ProjectInfo;

    if($projectAddress){
        $descriptionProject .= '<br/><strong>Addresse du projet : </strong><br/>' . $projectAddress;
    }
    $descriptionProject .= '<br/><strong>Prénom : </strong>' . $firstName;
    $descriptionProject .= '<br/><strong>Nom : </strong>' . $secondName;
    $descriptionProject .= '<br/><strong>Email : </strong>' . $email;
    $descriptionProject .= '<br/><strong>Téléphone : </strong>' . $phone;


    // SESSION

    if(isset($_COOKIE["cookieyes-consent"])){
        $cookieConsent = $_COOKIE["cookieyes-consent"];
        $searchConsent = strpos($cookieConsent, 'analytics:yes');
    }

    $utm_source = $searchConsent ? (isset($_SESSION['utm_source']) ? $_SESSION['utm_source'] : null) : null;
    $utm_medium = $searchConsent ? (isset($_SESSION['utm_medium']) ? $_SESSION['utm_medium'] : null) : null;
    $utm_campaign = $searchConsent ? (isset($_SESSION['utm_campaign']) ? $_SESSION['utm_campaign'] : null) : null;
    $utm_content = $searchConsent ? (isset($_SESSION['utm_content']) ? $_SESSION['utm_content'] : null) : null;
    $utm_term = $searchConsent ? (isset($_SESSION['utm_term']) ? $_SESSION['utm_term'] : null) : null;
    $gclid = $searchConsent ? (isset($_SESSION['gclid']) ? $_SESSION['gclid'] : null) : null;
    $wbraid = $searchConsent ? (isset($_SESSION['wbraid']) ? $_SESSION['wbraid'] : null) : null;


    if (isset($_FILES['images'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';


        $files = $_FILES['images'];
        $uploaded_images = [];

        // Limite à 3 fichiers
        if (count($files['name']) > 3) {
            wp_send_json_error(['message' => 'Vous ne pouvez envoyer que 3 images maximum.']);
            wp_die();
        }

        foreach ($files['name'] as $key => $value) {

            if ($files['error'][$key] !== UPLOAD_ERR_OK) {
                continue;
            }

            $file = [
                'name' => $files['name'][$key],
                'type' => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error' => $files['error'][$key],
                'size' => $files['size'][$key]
            ];

            $upload = wp_handle_upload($file, ['test_form' => false]);


            if (isset($upload['error'])) {
                continue;
            }

            // Insérer le média avec post_status "private" pour le masquer en BO
            $attachment_id = wp_insert_attachment([
                'post_mime_type' => $upload['type'],
                'post_title' => sanitize_file_name($file['name']),
                'post_content' => '',
                'post_status' => 'private'
            ], $upload['file']);


            if (!is_wp_error($attachment_id)) {
                update_post_meta($attachment_id, '_is_hidden_media', '1');
                $uploaded_images[] = $attachment_id;
            }
        }

        if (!empty($uploaded_images)) {
            $mediasHtml = '';
            $key = 1;
            foreach ($uploaded_images as $uploaded_image){
                $mediasHtml .= "<br/><a href='" . wp_get_attachment_url($uploaded_image) . "'>Document " . $key ."</a>";
                $key++;
            }
        }
    }

    //OBJ
    $opp = [
        'title' => "Site - " . $societyName, // Provenance (Site - Nom de l'entreprise
        'ref' => time(),
        "pipelinecol" => 1,
        "utm_source" => $utm_source,
        "utm_medium" => $utm_medium,
        "utm_campaign" => $utm_campaign,
        "utm_content" => $utm_content,
        "utm_term" => $utm_term,
        "gclid_wbraid" => $gclid . $wbraid
    ];


    
    if(isset($mediasHtml) && $mediasHtml){
        $opp['description'] = $descriptionProject . '<br/> <strong>Liste des fichiers</strong> : ' . $mediasHtml; // NOM PRENOM TEL EMAIL
    }else{
        $opp['description'] = $descriptionProject;
    }

    $tiers = [
        "name" => $societyName,
        "address" => $societyAddress,
        "phone" => $phone,
        "note_private" => ""
    ];

    $contact = [
        "firstname" => $firstName,
        "lastname" => $secondName,
        "phone"=> $phone,
        "email"=> $email,
        "country_id"=> 1,
        "note_private"=> "",
        "phone_pro"=> $phone,
        "address"=> $societyAddress
    ];

    $objSender['opp'] = $opp;
    $objSender['tiers'] = $tiers;
    $objSender['contact'] = $contact;


    // Token API CALL
    $url = 'https://atelier-gambetta.crm.freshprocess.eu/api/index.php/login';
    $args = [
        'body'      => [
            'login'    => 'support_api',
            'password' => 'X7oTJGhdfINP'
        ],
        'timeout'   => 10,
        'redirection' => 10,
        'blocking'  => true,
        'headers'   => [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ],
    ];

    $response = wp_remote_post($url, $args);

    // Vérification des erreurs
    if (is_wp_error($response)) {
        error_log('Erreur API FreshProcess : ' . $response->get_error_message());
        return;
    }

    // Récupération et décodage du corps de la réponse
    $response_body = wp_remote_retrieve_body($response);
    $response_data = json_decode($response_body, true);

    // Vérification de la présence du token
    $token_api = $response_data['success']['token'] ?? null;

    // POST DATAS API CALL
    $url = 'https://atelier-gambetta.crm.freshprocess.eu/api/index.php/gambetta/create-opportunity';

    $body = json_encode($objSender);


// Arguments de la requête
    $args = [
        'body'        => $body,
        'timeout'     => 10,
        'redirection' => 10,
        'blocking'    => true,
        'headers'     => [
            'Content-Type' => 'application/json',
            'DOLAPIKEY'    => $token_api,
        ],
    ];

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        error_log('Erreur API FreshProcess : ' . $response->get_error_message());
        return;
    }

// Récupération de la réponse
    $response_body = wp_remote_retrieve_body($response);
    $response_data = json_decode($response_body, true);

    if ($response_data) {
        error_log('Réponse API : ' . print_r($response_data, true));
    } else {
        error_log('Erreur : réponse vide ou invalide.');
    }

    if (is_wp_error($response)) {
        echo 'Erreur : ' . $response->get_error_message();
    } else {
        echo wp_remote_retrieve_body($response);
    }

    wp_die();
}

add_action('wp_ajax_add_opportunity', 'add_opportunity');
add_action('wp_ajax_nopriv_add_opportunity', 'add_opportunity');

function exclude_hidden_media_from_library($query) {
    if (is_admin() && $query->get('post_type') === 'attachment') {
        $meta_query = $query->get('meta_query') ?: [];
        $meta_query[] = [
            'key'     => '_is_hidden_media',
            'compare' => 'NOT EXISTS'
        ];
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'exclude_hidden_media_from_library');


// UTM

session_start();
function insert_utm_parameters() {
    $params = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid'];

    foreach ($params as $param) {
        if (isset($_GET[$param])) {
            $_SESSION[$param] = htmlspecialchars($_GET[$param], ENT_QUOTES, 'UTF-8');
        }
    }
}

// Appel de la fonction lors du chargement de la page
insert_utm_parameters();