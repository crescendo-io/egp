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
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( get_the_permalink() ) . '" />' . "\n";
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
    wp_enqueue_style('theme', get_stylesheet_directory_uri() . '/styles/theme.css?cache=3498398387918
    ', array(), filemtime(get_template_directory() . '/styles/theme.css'));
    wp_enqueue_script(
        'lightbox', // Identifiant unique du script
        get_stylesheet_directory_uri() . '/js/lightbox.min.js', // URL du fichier JS
        array( 'jquery' ), // Dépendances (si besoin, ici 'jquery')
        null, // Version du script (null pour désactiver la gestion des versions)
        true // Charger dans le footer (true) ou dans le header (false)
    );

    wp_enqueue_script(
        'script', // Identifiant unique du script
        get_stylesheet_directory_uri() . '/js/script.js?cache=349839637879', // URL du fichier JS
        array( 'jquery' ), // Dépendances (si besoin, ici 'jquery')
        null, // Version du script (null pour désactiver la gestion des versions)
        true // Charger dans le footer (true) ou dans le header (false)
    );

    wp_enqueue_script(
        'masonry', // Identifiant unique du script
        get_stylesheet_directory_uri() . '/js/masonry.js', // URL du fichier JS
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

    // Vérification des champs obligatoires
    $required_fields = ['society-name', 'society-address', 'society-address-town', 'society-address-zip', 'first-name', 'second-name', 'email', 'phone'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => 'Tous les champs sont obligatoires.']);
            wp_die();
        }
    }


    // POST
    $societyName    = isset($_POST['society-name']) ? sanitize_text_field(wp_strip_all_tags($_POST['society-name'])) : '';
    $societyAddress = isset($_POST['society-address']) ? sanitize_text_field(wp_strip_all_tags($_POST['society-address'])) : '';
    $societyAddressTown = isset($_POST['society-address-town']) ? sanitize_text_field(wp_strip_all_tags($_POST['society-address-town'])) : '';
    $societyAddressZip = isset($_POST['society-address-zip']) ? sanitize_text_field(wp_strip_all_tags($_POST['society-address-zip'])) : '';

    $projectAddress = isset($_POST['project-address']) ? sanitize_text_field(wp_strip_all_tags($_POST['project-address'])) : '';
    $projectAddressTown = isset($_POST['project-address-town']) ? sanitize_text_field(wp_strip_all_tags($_POST['project-address-town'])) : '';
    $projectAddressZip = isset($_POST['project-address-zip']) ? sanitize_text_field(wp_strip_all_tags($_POST['project-address-zip'])) : '';

    $firstName      = isset($_POST['first-name']) ? sanitize_text_field(wp_strip_all_tags($_POST['first-name'])) : '';
    $secondName     = isset($_POST['second-name']) ? sanitize_text_field(wp_strip_all_tags($_POST['second-name'])) : '';
    $ProjectInfo     = isset($_POST['description']) ? sanitize_text_field(wp_strip_all_tags($_POST['description'])) : '';
    $email          = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone          = isset($_POST['phone']) ? preg_replace('/[^0-9+]/', '', $_POST['phone']) : '';


    $descriptionProject = '<strong>Information du projet : </strong><br/>' . $ProjectInfo;

    if($projectAddress){
        $descriptionProject .= '<br/><strong>Addresse du projet : </strong><br/>' . $projectAddress . " " . $projectAddressTown . " " . $projectAddressZip;
    }
    $descriptionProject .= '<br/><strong>Addresse de la société : </strong><br/>' . $societyAddress . " " . $societyAddressTown . " " . $societyAddressZip;
    $descriptionProject .= '<br/><strong>Prénom : </strong>' . $firstName;
    $descriptionProject .= '<br/><strong>Nom : </strong>' . $secondName;
    $descriptionProject .= '<br/><strong>Email : </strong>' . $email;
    $descriptionProject .= '<br/><strong>Téléphone : </strong>' . $phone;


    // SESSION

    if(isset($_COOKIE["_ga"])){
        $cookieConsent = $_COOKIE["_ga"];
        $searchConsent = true;
    }

    $utm_source = $searchConsent ? (isset($_SESSION['utm_source']) ? $_SESSION['utm_source'] : null) : null;
    $utm_medium = $searchConsent ? (isset($_SESSION['utm_medium']) ? $_SESSION['utm_medium'] : null) : null;
    $utm_campaign = $searchConsent ? (isset($_SESSION['utm_campaign']) ? $_SESSION['utm_campaign'] : null) : null;
    $utm_content = $searchConsent ? (isset($_SESSION['utm_content']) ? $_SESSION['utm_content'] : null) : null;
    $utm_term = $searchConsent ? (isset($_SESSION['utm_term']) ? $_SESSION['utm_term'] : null) : null;
    $gclid = $searchConsent ? (isset($_SESSION['gclid']) ? $_SESSION['gclid'] : null) : null;
    $wbraid = $searchConsent ? (isset($_SESSION['wbraid']) ? $_SESSION['wbraid'] : null) : null;



    $uploaded_files = [];
    if (isset($_FILES['images'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $files = $_FILES['images'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        $allowed_ext   = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $max_size      = 5 * 1024 * 1024; // 5 Mo

        // Limite à 3 fichiers
        if (count($files['name']) > 3) {
            wp_send_json_error(['message' => 'Vous ne pouvez envoyer que 3 fichiers maximum.']);
            wp_die();
        }

        $upload_dir = wp_upload_dir();
        $target_dir = $upload_dir['basedir'] . '/opportunity/';

        if (!file_exists($target_dir)) {
            wp_mkdir_p($target_dir);
        }

        foreach ($files['name'] as $key => $value) {
            if ($files['error'][$key] !== UPLOAD_ERR_OK) {
                continue;
            }

            // Vérification de la taille du fichier
            if ($files['size'][$key] > $max_size) {
                wp_send_json_error(['message' => 'Un fichier dépasse la taille maximale de 5 Mo.']);
                wp_die();
            }

            // Vérification de l'extension du fichier
            $file_ext = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));
            if (!in_array($file_ext, $allowed_ext)) {
                wp_send_json_error(['message' => 'Seuls les fichiers JPG, PNG, GIF et PDF sont autorisés.']);
                wp_die();
            }

            // Vérification du type MIME
            $mime_type = mime_content_type($files['tmp_name'][$key]);
            if (!in_array($mime_type, $allowed_types)) {
                wp_send_json_error(['message' => 'Le fichier "' . $files['name'][$key] . '" n\'est pas un fichier valide.']);
                wp_die();
            }

            // Vérification avec WordPress
            $file_info = wp_check_filetype($files['name'][$key]);
            if (!in_array(strtolower($file_info['ext']), $allowed_ext)) {
                wp_send_json_error(['message' => 'Le fichier contient un type non autorisé.']);
                wp_die();
            }

            // Déplacer le fichier sécurisé
            $filename = sanitize_file_name($files['name'][$key]);
            $target_path = $target_dir . $filename;

            if (move_uploaded_file($files['tmp_name'][$key], $target_path)) {
                $uploaded_files[] = $upload_dir['baseurl'] . '/opportunity/' . $filename;
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
        "wbraid" => $wbraid,
        "gclid" => $gclid
    ];




    if (!empty($uploaded_files)) {
        $mediasHtml = '';
        $key = 1;

        foreach ($uploaded_files as $uploaded_image) {
            $mediasHtml .= "<br/><a href='" . $uploaded_image . "' target='_blank'>Document " . $key . "</a>";
            $key++;
        }
    }

    
    if(isset($mediasHtml) && $mediasHtml){
        $opp['description'] = $descriptionProject . '<br/> <strong>Liste des fichiers</strong> : ' . $mediasHtml; // NOM PRENOM TEL EMAIL
    }else{
        $opp['description'] = $descriptionProject;
    }


    $tiers = [
        "name" => $societyName,
        "address" => $societyAddress,
        "phone" => $phone,
        "note_private" => "",
        "town" => $societyAddressTown,
        "zip" => $societyAddressZip
    ];

    $contact = [
        "firstname" => $firstName,
        "lastname" => $secondName,
        "phone"=> $phone,
        "email"=> $email,
        "country_id"=> 1,
        "note_private"=> "",
        "phone_pro"=> $phone,
        "address"=> $societyAddress,
        "town" => $societyAddressTown,
        "zip" => $societyAddressZip
    ];

    // ========================================
    // ENVOI VERS PIPEDRIVE
    // ========================================
    
    $api_token = 'dc709fbe3e1fc31fa63a75c0e4099d928afd39ca';
    $pipedrive_errors = [];
    
    // 1) Créer l'organisation
    $org_data = [
        'name' => $societyName,
        'address' => $societyAddress . ', ' . $societyAddressZip . ' ' . $societyAddressTown,
    ];
    
    $org_response = wp_remote_post("https://api.pipedrive.com/v1/organizations?api_token={$api_token}", [
        'timeout' => 20,
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode($org_data),
    ]);
    
    $org_id = null;
    if (!is_wp_error($org_response)) {
        $org_body = json_decode(wp_remote_retrieve_body($org_response), true);
        $org_id = $org_body['data']['id'] ?? null;
    } else {
        $pipedrive_errors[] = 'Erreur création organisation: ' . $org_response->get_error_message();
    }
    
    // 2) Créer la personne (contact)
    $person_data = [
        'name' => $firstName . ' ' . $secondName,
        'email' => [$email],
        'phone' => [$phone],
        'org_id' => $org_id,
    ];
    
    $person_response = wp_remote_post("https://api.pipedrive.com/v1/persons?api_token={$api_token}", [
        'timeout' => 20,
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode($person_data),
    ]);
    
    $person_id = null;
    if (!is_wp_error($person_response)) {
        $person_body = json_decode(wp_remote_retrieve_body($person_response), true);
        $person_id = $person_body['data']['id'] ?? null;
    } else {
        $pipedrive_errors[] = 'Erreur création personne: ' . $person_response->get_error_message();
    }
    
    // 3) Créer le deal
    // Clés des champs personnalisés
    $FIELD_ADDRESS = '542d02944d09ca0fccd0bd7e239ca07613086ae2';      // Adresse d'installation
    $FIELD_PROJECT_INFO = '52443409ad9636122e6596305d2ed1a3c1cb6f9d'; // Note Information du projet
    $FIELD_GCLID = '72b31b6f20e15e3bec5225122f9b43539e0ca395';        // gclid
    $FIELD_WBRAID = 'e3bf20c1ef4989cc07eef8c87a05e46e664df071';       // wbraid
    $FIELD_UTM_SOURCE = '78313cb1c2b6733c61930eb0d0089a6f73adb107';   // utm_source
    $FIELD_UTM_MEDIUM = 'eb81a0d857c5b38a6fde2a776eb9aa201fea2f83';   // utm_medium
    $FIELD_UTM_CAMPAIGN = '017b423da414a8447f699f99d9012e49bd88e5ca'; // utm_campaign
    $FIELD_UTM_CONTENT = '9adf14b638e90ddf8da2796f2a44892dd2c5f2fa';  // utm_content
    $FIELD_UTM_TERM = '7e60cb9a2b5d175d7a2497bec97a93aaaf036dee';     // utm_term
    $FIELD_SYNC = '3efe132b7fa2e85d872e5df378ecac1a2cb4b371';         // Synchronisation (319=envoyées)
    
    // Construire l'adresse d'installation
    $installation_address = $projectAddress ? $projectAddress . ', ' . $projectAddressZip . ' ' . $projectAddressTown : '';
    
    // Description avec les fichiers
    $deal_description = $descriptionProject;
    if (isset($mediasHtml) && $mediasHtml) {
        $deal_description .= '<br/><strong>Liste des fichiers</strong> : ' . $mediasHtml;
    }
    
    $deal_data = [
        'title' => 'Site - ' . $societyName,
        'org_id' => $org_id,
        'person_id' => $person_id,
        'stage_id' => 1, // Premier stage du pipeline (à ajuster selon votre config)
        $FIELD_PROJECT_INFO => $deal_description,
        $FIELD_GCLID => $gclid,
        $FIELD_WBRAID => $wbraid,
        $FIELD_UTM_SOURCE => $utm_source,
        $FIELD_UTM_MEDIUM => $utm_medium,
        $FIELD_UTM_CAMPAIGN => $utm_campaign,
        $FIELD_UTM_CONTENT => $utm_content,
        $FIELD_UTM_TERM => $utm_term,
        $FIELD_SYNC => 319, // Données envoyées 📤 (Opport. Brouillon)
    ];
    
    // Ajouter l'adresse d'installation si disponible
    if ($installation_address) {
        $deal_data[$FIELD_ADDRESS] = $installation_address;
    }
    
    $deal_response = wp_remote_post("https://api.pipedrive.com/v1/deals?api_token={$api_token}", [
        'timeout' => 20,
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode($deal_data),
    ]);
    
    $deal_id = null;
    if (!is_wp_error($deal_response)) {
        $deal_body = json_decode(wp_remote_retrieve_body($deal_response), true);
        $deal_id = $deal_body['data']['id'] ?? null;
        
        if (!$deal_body['success']) {
            $pipedrive_errors[] = 'Erreur création deal: ' . ($deal_body['error'] ?? 'Erreur inconnue');
        }
    } else {
        $pipedrive_errors[] = 'Erreur création deal: ' . $deal_response->get_error_message();
    }
    
    // 4) Attacher les fichiers au deal Pipedrive
    $uploaded_file_ids = [];
    if ($deal_id && !empty($uploaded_files)) {
        $upload_dir = wp_upload_dir();
        $target_dir = $upload_dir['basedir'] . '/opportunity/';
        
        foreach ($uploaded_files as $file_url) {
            // Récupérer le chemin local du fichier
            $filename = basename($file_url);
            $file_path = $target_dir . $filename;
            
            if (file_exists($file_path)) {
                // Utiliser cURL pour l'upload multipart (wp_remote_post ne gère pas bien les fichiers)
                $curl = curl_init();
                
                $post_fields = [
                    'file' => new CURLFile($file_path, mime_content_type($file_path), $filename),
                    'deal_id' => $deal_id,
                ];
                
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://api.pipedrive.com/v1/files?api_token={$api_token}",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $post_fields,
                    CURLOPT_HTTPHEADER => [
                        'Accept: application/json',
                    ],
                    CURLOPT_TIMEOUT => 30,
                ]);
                
                $file_response = curl_exec($curl);
                $curl_error = curl_error($curl);
                curl_close($curl);
                
                if ($curl_error) {
                    $pipedrive_errors[] = "Erreur upload fichier {$filename}: {$curl_error}";
                } else {
                    $file_data = json_decode($file_response, true);
                    if (isset($file_data['data']['id'])) {
                        $uploaded_file_ids[] = $file_data['data']['id'];
                    } else {
                        $pipedrive_errors[] = "Erreur upload fichier {$filename}: " . ($file_data['error'] ?? 'Erreur inconnue');
                    }
                }
            }
        }
    }
    
    // Log pour debug
    $log_file = get_stylesheet_directory() . '/pipedrive-form.log';
    $log_entry = "=== " . date('Y-m-d H:i:s') . " ===\n";
    $log_entry .= "Société: {$societyName}\n";
    $log_entry .= "Contact: {$firstName} {$secondName} - {$email} - {$phone}\n";
    $log_entry .= "Org ID: {$org_id}\n";
    $log_entry .= "Person ID: {$person_id}\n";
    $log_entry .= "Deal ID: {$deal_id}\n";
    $log_entry .= "Fichiers uploadés: " . count($uploaded_file_ids) . " (" . implode(', ', $uploaded_file_ids) . ")\n";
    if (!empty($pipedrive_errors)) {
        $log_entry .= "Erreurs: " . implode(', ', $pipedrive_errors) . "\n";
    }
    $log_entry .= "========================================\n\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND);
    
    // Réponse
    if ($deal_id) {
        wp_send_json_success([
            'message' => 'Demande envoyée avec succès !',
            'deal_id' => $deal_id,
        ]);
    } else {
        wp_send_json_error([
            'message' => 'Erreur lors de l\'envoi de la demande.',
            'errors' => $pipedrive_errors,
        ]);
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



add_action('after_setup_theme', 'child_remove_rest_security_parent', 20);
function child_remove_rest_security_parent() {
    remove_filter('rest_api_init', 'rest_only_for_authorized_users', 99);
}



// 1) Déclarer la route REST pour le webhook Pipedrive
add_action('rest_api_init', function () {
    register_rest_route('pipedrive/v1', '/webhook', [
        'methods' => 'POST',
        'callback' => 'handle_pipedrive_webhook',
        'permission_callback' => '__return_true', // on gère la "sécurité" nous-mêmes
    ]);
});

/**
 * 2) Fonction appelée quand Pipedrive envoie le webhook
 */
function handle_pipedrive_webhook(WP_REST_Request $request)
{

    // Vérifier un petit "secret" dans l’URL pour éviter les appels abusifs
    $secret = isset($_GET['secret']) ? $_GET['secret'] : '';
    $secret_attendu = 'f1c3b8a4d7e94c29a0fb873d51e6f92c6a48e1bd2ff04d7cb5689c3e0a1df7b2'; // à changer !

    if ($secret !== $secret_attendu) {
        return new WP_REST_Response(
            ['error' => 'Unauthorized'],
            401
        );
    }

    // Récupérer les données envoyées par Pipedrive (JSON)
    $body = $request->get_json_params();

    // Appeler TA fonction perso avec les données du webhook
    // À toi de coder la logique à l’intérieur
    my_pipedrive_action($body);

    // Réponse à Pipedrive
    return new WP_REST_Response(
        ['status' => 'ok'],
        200
    );
}

/**
 * 3) Ta fonction métier, où tu fais ce que tu veux avec les données
 *    (création d’utilisateur, mise à jour d’un post, envoi d’email, etc.)
 */
function my_pipedrive_action($data)
{
    // Log des données dans un fichier
    $log_file = __DIR__ . '/pipedrive-log.txt';
    file_put_contents($log_file, date('Y-m-d H:i:s') . " - " . print_r($data, true) . "\n\n", FILE_APPEND);

    // Récupérer l'ID du deal depuis les données du webhook
    $deal_id = $data['current']['id'] ?? $data['meta']['id'] ?? null;
    
    if ($deal_id) {
        // Envoyer les données vers FreshProcess
        $result = add_data_to_fresh($deal_id);
        
        // Log du résultat
        file_put_contents($log_file, date('Y-m-d H:i:s') . " - FreshProcess sync pour deal {$deal_id}: " . print_r($result, true) . "\n\n", FILE_APPEND);
    }
}



function get_pipedrive_deal( $deal_id = 3 ) {
    $api_token = 'dc709fbe3e1fc31fa63a75c0e4099d928afd39ca';
    $base_url = "https://api.pipedrive.com/api/v2/deals/{$deal_id}";

    $args_url = array(
        'include_fields' => 'next_activity_id,files_count,last_activity_id',
    );

    $url = add_query_arg( $args_url, $base_url );

    // 1) CALL : récupération du deal
    $response = wp_remote_get( $url, array(
        'timeout' => 20,
        'headers' => array(
            'Accept'      => 'application/json',
            'x-api-token' => $api_token,
        ),
    ) );

    // Gestion erreurs HTTP
    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $responseBody  = json_decode( wp_remote_retrieve_body( $response ) );
    $responseDatas = !empty( $responseBody->data ) ? $responseBody->data : null;

    if ( empty( $responseDatas ) ) {
        return new WP_Error( 'pipedrive_no_data', 'Aucune donnée de deal retournée par Pipedrive.' );
    }


    // Champs du deal
    $deal_title    = $responseDatas->title ?? null;
    $deal_id    = $responseDatas->id ?? null;
    $person_id  = $responseDatas->person_id ?? null;
    $org_id     = $responseDatas->org_id ?? null;
    $stage_id   = $responseDatas->stage_id ?? null;
    $add_time   = $responseDatas->add_time ?? null;
    $update_time = $responseDatas->update_time ?? null;

    // Custom fields (en sécurisant un minimum)
    $budget = $responseDatas->custom_fields->d538bdd17337141f971879a961f362dbea5c5a7e->value ?? null;

    $address      = $responseDatas->custom_fields->{'542d02944d09ca0fccd0bd7e239ca07613086ae2'} ?? null;
    $projectInfo  = $responseDatas->custom_fields->{'52443409ad9636122e6596305d2ed1a3c1cb6f9d'} ?? null;
    $gclid        = $responseDatas->custom_fields->{'72b31b6f20e15e3bec5225122f9b43539e0ca395'} ?? null;
    $wbraid       = $responseDatas->custom_fields->{'e3bf20c1ef4989cc07eef8c87a05e46e664df071'} ?? null;
    $utm_campaign = $responseDatas->custom_fields->{'017b423da414a8447f699f99d9012e49bd88e5ca'} ?? null;
    $utm_content  = $responseDatas->custom_fields->{'9adf14b638e90ddf8da2796f2a44892dd2c5f2fa'} ?? null;
    $utm_source   = $responseDatas->custom_fields->{'78313cb1c2b6733c61930eb0d0089a6f73adb107'} ?? null;


    // 2) CALL : si on a un person_id, on va chercher la fiche personne
    $person_data = null;

    if ( !empty( $person_id ) ) {

        $person_url = "https://api.pipedrive.com/api/v2/persons/{$person_id}";

        $person_response = wp_remote_get( $person_url, array(
            'timeout' => 20,
            'headers' => array(
                'Accept'      => 'application/json',
                'x-api-token' => $api_token,
            ),
        ) );

        if ( !is_wp_error( $person_response ) ) {
            $person_body = json_decode( wp_remote_retrieve_body( $person_response ) );
            $person_data = $person_body->data ?? null;
        }
    }

    $organisation_data = null;

    if ( !empty( $org_id ) ) {

        $organisation_url = "https://api.pipedrive.com/api/v2/organizations/{$org_id}";

        $organisation_response = wp_remote_get( $organisation_url, array(
            'timeout' => 20,
            'headers' => array(
                'Accept'      => 'application/json',
                'x-api-token' => $api_token,
            ),
        ) );

        if ( !is_wp_error( $organisation_response ) ) {
            $organisation_body = json_decode( wp_remote_retrieve_body( $organisation_response ) );
            $organisation_data = $organisation_body->data ?? null;
        }
    }


    // Tu peux retourner ce que tu veux : ici, un tableau structuré
    $deal =  array(
        'deal'   => array(
            'id'          => $deal_id,
            'deal_title'  => $deal_title,
            'person_id'   => $person_id,
            'org_id'      => $org_id,
            'stage_id'    => $stage_id,
            'add_time'    => $add_time,
            'update_time' => $update_time,
            'budget'      => $budget,
            'address'     => $address,
            'projectInfo' => $projectInfo,
            'gclid'       => $gclid,
            'wbraid'      => $wbraid,
            'utm_campaign'=> $utm_campaign,
            'utm_content' => $utm_content,
            'utm_source'  => $utm_source,
        ),
        'person' => $person_data,
        'organisation' => $organisation_data,
    );


    return $deal;
}


function get_token_fresh(){
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
    $responseBody = json_decode($response['body']);
    if(isset($responseBody->success->token)){
        $token = $responseBody->success->token;
    }else{
        $token = null;
    }

    return $token;
}

function add_data_to_fresh($deal_id = null) {
    
    if (!$deal_id) {
        return ['success' => false, 'error' => 'Deal ID manquant'];
    }

    $datas = get_pipedrive_deal($deal_id);
    
    // Vérifier si get_pipedrive_deal a retourné une erreur
    if (is_wp_error($datas)) {
        return ['success' => false, 'error' => $datas->get_error_message(), 'deal_id' => $deal_id];
    }
    
    // Vérifier si les données sont valides
    if (empty($datas) || !is_array($datas)) {
        return ['success' => false, 'error' => 'Données du deal invalides ou vides', 'deal_id' => $deal_id];
    }
    
    $freshToken = get_token_fresh();


    // Datas opp
    $deal_title = $datas['deal']['deal_title'] ?? null;
    $deal_id = $datas['deal']['id'] ?? null;
    $projectInfo = $datas['deal']['projectInfo'] ?? null;
    $gclid = $datas['deal']['gclid'] ?? null;
    $wbraid = $datas['deal']['wbraid'] ?? null;
    $utm_campaign = $datas['deal']['utm_campaign'] ?? null;
    $utm_content = $datas['deal']['utm_content'] ?? null;
    $utm_source = $datas['deal']['utm_source'] ?? null;
    $deal_address = $datas['deal']['address']->value ?? null;

    //Datas organisation
    $organisation_name = $datas['organisation']->name ?? null;
    $organisation_address = isset($datas['organisation']->address->value) ? $datas['organisation']->address->value : null;

    // Datas Person (avec vérifications null-safe)
    $person_phone_value = null;
    $person_fistname = null;
    $person_lastname = null;
    $person_email_value = null;
    
    if (!empty($datas['person'])) {
        $person = $datas['person'];
        
        // Téléphone
        if (!empty($person->phones) && is_array($person->phones)) {
            $person_phone_reset = reset($person->phones);
            $person_phone_value = $person_phone_reset->value ?? null;
        }
        
        // Nom / Prénom
        $person_fistname = $person->first_name ?? null;
        $person_lastname = $person->last_name ?? null;
        
        // Email
        if (!empty($person->emails) && is_array($person->emails)) {
            $person_email_reset = reset($person->emails);
            $person_email_value = $person_email_reset->value ?? null;
        }
    }


    $url = 'https://atelier-gambetta.crm.freshprocess.eu/api/index.php/gambetta/create-opportunity';

    // On construit les données en tableau PHP
    $data = array(
        'opp' => array(
            'title'        => $deal_title,
            'ref'          => 'pipedrive_' . $deal_id,
            'description'  => $projectInfo,
            'note_public'  => "Note publique concernant l'opportunité.",
            'pipelinecol'  => 1,
            'utm_source'   => $utm_source,
            'utm_medium'   => 'cpc',
            'utm_campaign' => $utm_campaign,
            'utm_content'  => $utm_content,
            'utm_term'     => 'achat lampe',
            "wbraid" => $wbraid,
            "gclid" => $gclid
        ),
        'tiers' => array(
            'name'         => $organisation_name,
            'address'      => $organisation_address,
            'phone'        => $person_phone_value,
            'note_private' => '',
        ),
        'contact' => array(
            [
                'firstname'    => $person_fistname,
                'lastname'     => $person_lastname,
                'phone'        => $person_phone_value,
                'email'        => $person_email_value,
                'country_id'   => 1,
                'note_private' => 'Importé de Pipedrive',
                'phone_pro'    => $person_phone_value,
                'address'      => $organisation_address,
            ],
            [
                'firstname'    => $organisation_name,
                'lastname'     => 'Adresse du projet',
                'phone'        => $person_phone_value,
                'email'        => $person_email_value,
                'country_id'   => 1,
                'note_private' => 'Importé de Pipedrive',
                'phone_pro'    => $person_phone_value,
                'address'      => $deal_address,
            ]
        ),
    );

    $args = array(
        'method'      => 'POST',
        'timeout'     => 20,
        'redirection' => 10,
        'httpversion' => '1.1',
        'blocking'    => true,
        'headers'     => array(
            'Content-Type' => 'application/json',
            'DOLAPIKEY'    => $freshToken,
        ),
        'body'        => wp_json_encode( $data ),
    );

    $response = wp_remote_post( $url, $args );

    if ( is_wp_error( $response ) ) {
        // Gestion d'erreur WordPress
        error_log( 'Erreur requête Gambetta : ' . $response->get_error_message() );
        return ['success' => false, 'error' => $response->get_error_message()];
    }

    // Corps de la réponse
    $body = wp_remote_retrieve_body( $response );
    $response_data = json_decode($body, true);
    
    return [
        'success' => true,
        'deal_id' => $deal_id,
        'fresh_response' => $response_data
    ];
}


//add_data_to_fresh();

function get_referentiel($source = null, $id = null, $referentiel = 'priority')
{
    // Référentiel priority
    $priority = [
        ['fresh' => 24, 'pipedrive' => 24],
        ['fresh' => 45, 'pipedrive' => 25],
        ['fresh' => 32, 'pipedrive' => 26],
    ];

    // Référentiel category_child
    $category_child = [
        ['fresh' => 139, 'pipedrive' => 139],
        ['fresh' => 140, 'pipedrive' => 140],
        ['fresh' => 141, 'pipedrive' => 141],
        ['fresh' => 142, 'pipedrive' => 142],
        ['fresh' => 143, 'pipedrive' => 143],
        ['fresh' => 144, 'pipedrive' => 144],
        ['fresh' => 145, 'pipedrive' => 145],
        ['fresh' => 146, 'pipedrive' => 146],
        ['fresh' => 147, 'pipedrive' => 147],
        ['fresh' => 148, 'pipedrive' => 148],
        ['fresh' => 149, 'pipedrive' => 149],
        ['fresh' => 150, 'pipedrive' => 150],
        ['fresh' => 151, 'pipedrive' => 151],
        ['fresh' => 152, 'pipedrive' => 152],
        ['fresh' => 153, 'pipedrive' => 153],
        ['fresh' => 154, 'pipedrive' => 154],
        ['fresh' => 155, 'pipedrive' => 155],
        ['fresh' => 156, 'pipedrive' => 156],
        ['fresh' => 157, 'pipedrive' => 157],
        ['fresh' => 158, 'pipedrive' => 158],
        ['fresh' => 159, 'pipedrive' => 159],
        ['fresh' => 160, 'pipedrive' => 160],
        ['fresh' => 161, 'pipedrive' => 161],
        ['fresh' => 162, 'pipedrive' => 162],
        ['fresh' => 163, 'pipedrive' => 163],
        ['fresh' => 164, 'pipedrive' => 164],
        ['fresh' => 165, 'pipedrive' => 165],
        ['fresh' => 166, 'pipedrive' => 166],
        ['fresh' => 167, 'pipedrive' => 167],
        ['fresh' => 168, 'pipedrive' => 168],
        ['fresh' => 169, 'pipedrive' => 169],
        ['fresh' => 170, 'pipedrive' => 170],
        ['fresh' => 171, 'pipedrive' => 171],
        ['fresh' => 172, 'pipedrive' => 172],
        ['fresh' => 173, 'pipedrive' => 173],
        ['fresh' => 174, 'pipedrive' => 174],
        ['fresh' => 175, 'pipedrive' => 175],
        ['fresh' => 176, 'pipedrive' => 176],
        ['fresh' => 177, 'pipedrive' => 177],
        ['fresh' => 178, 'pipedrive' => 178],
        ['fresh' => 179, 'pipedrive' => 179],
        ['fresh' => 180, 'pipedrive' => 180],
        ['fresh' => 181, 'pipedrive' => 181],
        ['fresh' => 182, 'pipedrive' => 182],
        ['fresh' => 183, 'pipedrive' => 183],
        ['fresh' => 184, 'pipedrive' => 184],
        ['fresh' => 185, 'pipedrive' => 185],
        ['fresh' => 186, 'pipedrive' => 186],
        ['fresh' => 187, 'pipedrive' => 187],
        ['fresh' => 188, 'pipedrive' => 188],
        ['fresh' => 189, 'pipedrive' => 189],
        ['fresh' => 190, 'pipedrive' => 190],
        ['fresh' => 191, 'pipedrive' => 191],
        ['fresh' => 192, 'pipedrive' => 192],
        ['fresh' => 193, 'pipedrive' => 193],
        ['fresh' => 194, 'pipedrive' => 194],
        ['fresh' => 195, 'pipedrive' => 195],
        ['fresh' => 196, 'pipedrive' => 196],
        ['fresh' => 197, 'pipedrive' => 197],
        ['fresh' => 198, 'pipedrive' => 198],
        ['fresh' => 199, 'pipedrive' => 199],
        ['fresh' => 200, 'pipedrive' => 200],
        ['fresh' => 201, 'pipedrive' => 201],
        ['fresh' => 202, 'pipedrive' => 202],
        ['fresh' => 203, 'pipedrive' => 203],
        ['fresh' => 204, 'pipedrive' => 204],
        ['fresh' => 205, 'pipedrive' => 205],
        ['fresh' => 206, 'pipedrive' => 206],
        ['fresh' => 207, 'pipedrive' => 207],
        ['fresh' => 208, 'pipedrive' => 208],
        ['fresh' => 209, 'pipedrive' => 209],
        ['fresh' => 210, 'pipedrive' => 210],
        ['fresh' => 211, 'pipedrive' => 211],
        ['fresh' => 212, 'pipedrive' => 212],
        ['fresh' => 213, 'pipedrive' => 213],
        ['fresh' => 214, 'pipedrive' => 214],
        ['fresh' => 215, 'pipedrive' => 215],
        ['fresh' => 216, 'pipedrive' => 216],
        ['fresh' => 217, 'pipedrive' => 217],
        ['fresh' => 218, 'pipedrive' => 218],
        ['fresh' => 219, 'pipedrive' => 219],
        ['fresh' => 220, 'pipedrive' => 220],
        ['fresh' => 221, 'pipedrive' => 221],
        ['fresh' => 222, 'pipedrive' => 222],
        ['fresh' => 223, 'pipedrive' => 223],
        ['fresh' => 224, 'pipedrive' => 224],
        ['fresh' => 225, 'pipedrive' => 225],
        ['fresh' => 226, 'pipedrive' => 226],
        ['fresh' => 227, 'pipedrive' => 227],
        ['fresh' => 228, 'pipedrive' => 228],
        ['fresh' => 229, 'pipedrive' => 229],
        ['fresh' => 230, 'pipedrive' => 230],
        ['fresh' => 231, 'pipedrive' => 231],
        ['fresh' => 888, 'pipedrive' => 232],
        ['fresh' => 233, 'pipedrive' => 233],
        ['fresh' => 234, 'pipedrive' => 234],
        ['fresh' => 235, 'pipedrive' => 235],
        ['fresh' => 236, 'pipedrive' => 236],
        ['fresh' => 237, 'pipedrive' => 237],
        ['fresh' => 238, 'pipedrive' => 238],
        ['fresh' => 239, 'pipedrive' => 239],
        ['fresh' => 240, 'pipedrive' => 240],
        ['fresh' => 241, 'pipedrive' => 241],
        ['fresh' => 242, 'pipedrive' => 242],
        ['fresh' => 243, 'pipedrive' => 243],
        ['fresh' => 244, 'pipedrive' => 244],
        ['fresh' => 245, 'pipedrive' => 245],
        ['fresh' => 246, 'pipedrive' => 246],
        ['fresh' => 247, 'pipedrive' => 247],
        ['fresh' => 248, 'pipedrive' => 248],
        ['fresh' => 249, 'pipedrive' => 249],
        ['fresh' => 250, 'pipedrive' => 250],
        ['fresh' => 251, 'pipedrive' => 251],
        ['fresh' => 252, 'pipedrive' => 252],
        ['fresh' => 253, 'pipedrive' => 253],
        ['fresh' => 254, 'pipedrive' => 254],
        ['fresh' => 255, 'pipedrive' => 255],
        ['fresh' => 256, 'pipedrive' => 256],
        ['fresh' => 257, 'pipedrive' => 257],
        ['fresh' => 258, 'pipedrive' => 258],
        ['fresh' => 259, 'pipedrive' => 259],
        ['fresh' => 260, 'pipedrive' => 260],
        ['fresh' => 261, 'pipedrive' => 261],
        ['fresh' => 262, 'pipedrive' => 262],
        ['fresh' => 263, 'pipedrive' => 263],
        ['fresh' => 264, 'pipedrive' => 264],
        ['fresh' => 265, 'pipedrive' => 265],
        ['fresh' => 266, 'pipedrive' => 266],
        ['fresh' => 267, 'pipedrive' => 267],
        ['fresh' => 268, 'pipedrive' => 268],
        ['fresh' => 269, 'pipedrive' => 269],
        ['fresh' => 270, 'pipedrive' => 270],
        ['fresh' => 271, 'pipedrive' => 271],
        ['fresh' => 272, 'pipedrive' => 272],
        ['fresh' => 273, 'pipedrive' => 273],
        ['fresh' => 274, 'pipedrive' => 274],
        ['fresh' => 275, 'pipedrive' => 275],
    ];

    // Choisir le référentiel selon le paramètre
    switch ($referentiel) {
        case 'priority':
            $datas = $priority;
            break;
        case 'category_child':
            $datas = $category_child;
            break;
        default:
            return null; // Cas où le référentiel n'est pas reconnu
    }

    // Si source ou id sont non précisés, retourner toutes les données
    if ($source === null || $id === null) {
        return $datas;
    }

    // Recherche dans les données du référentiel
    foreach ($datas as $row) {
        if ($source === 'pipedrive' && $row['pipedrive'] == $id) {
            return $row['fresh']; // Retourne la valeur fresh correspondante
        }
        if ($source === 'fresh' && $row['fresh'] == $id) {
            return $row['pipedrive']; // Retourne la valeur pipedrive correspondante
        }
    }

    return null; // Retourne null si aucune correspondance trouvée
}
// echo get_referentiel('fresh', 888, 'category_child');


/**
 * Route API pour recevoir les webhooks FreshProcess
 */
add_action('rest_api_init', function () {
    register_rest_route('egp/v1', '/freshprocess-webhook', [
        'methods'  => 'POST',
        'callback' => 'handle_freshprocess_webhook',
        'permission_callback' => '__return_true',
    ]);
});

function handle_freshprocess_webhook(WP_REST_Request $request) {
    // Récupérer les données POST
    $body = $request->get_body();
    $params = $request->get_params();
    $headers = $request->get_headers();
    
    // Chemin du fichier de log
    $log_file = get_stylesheet_directory() . '/freshprocess-webhook.log';
    
    // Écrire dans le fichier de log
    $log_entry = "=== " . date('Y-m-d H:i:s') . " ===\n";
    $log_entry .= "Body: " . $body . "\n";
    $log_entry .= "Params: " . json_encode($params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
    // Mettre à jour le deal Pipedrive
    $pipedrive_result = update_pipedrive_deal_from_fresh($params);
    
    $log_entry .= "Pipedrive Response: " . json_encode($pipedrive_result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    $log_entry .= "========================================\n\n";
    
    file_put_contents($log_file, $log_entry, FILE_APPEND);
    
    // Retourner une réponse de succès
    return new WP_REST_Response([
        'success' => true,
        'message' => 'Webhook reçu et envoyé à Pipedrive',
        'pipedrive_response' => $pipedrive_result
    ], 200);
}

/**
 * Met à jour un deal Pipedrive avec les données FreshProcess
 */
function update_pipedrive_deal_from_fresh($fresh_data) {
    $api_token = 'dc709fbe3e1fc31fa63a75c0e4099d928afd39ca';
    $deal_id = 4; // ID du deal Pipedrive en dur pour les tests
    
    // Clés des champs personnalisés Pipedrive - INFO DEVIS 1
    $FIELD_LIEN_DEVIS = 'f2e33f128fa41f70d54526d021a2c4637b4d01b2';      // 01 - Lien du Devis (varchar)
    $FIELD_REF = '5707788962bd07a846e8e7908cab20d044b43ab7';             // 02 - Ref (varchar)
    $FIELD_MONTANT_HT = '7ab7fd57a0f7ae28bbbf740ecd02b464e4872672';      // 03 - Montant HT (monetary)
    $FIELD_STATU = '4cc903fdebdd6390d4f8cd1b598bccf1d38b2ffd';           // 04 - Statu (enum: 100=VALIDÉ, 101=BROUILLON)
    $FIELD_LIEN_SIGNATURE = '2b51d7ea3bd67edd002cae7c8552298fded62879';  // 05 - Lien Signature (varchar)
    $FIELD_DATE_FIN_VALIDITE = 'ee1799557507143ca6935a5e4c928a7d70739cce'; // 06 - Date fin Validité (date)
    
    // Autres champs utiles
    $FIELD_SYNC = '3efe132b7fa2e85d872e5df378ecac1a2cb4b371';            // Synchronisation (319=envoyées, 321=traitées)
    $FIELD_LIEN_FRESH = 'ff0bca4afeb2df248cf48b9c6b1fda7b740a1993';      // Lien Opportunité Fresh Process
    $FIELD_GCLID = '72b31b6f20e15e3bec5225122f9b43539e0ca395';           // gclid
    
    // Extraire les données de FreshProcess
    $object_type = $fresh_data['object_type'] ?? null;
    $object_id = $fresh_data['object_id'] ?? null;
    $object_ref = $fresh_data['object_ref'] ?? null;
    $date_creation = $fresh_data['date_creation'] ?? null;
    $project_id = $fresh_data['project_id'] ?? null;
    $gclid = $fresh_data['gclid'] ?? null;
    $name = $fresh_data['name'] ?? null;
    $soc_id = $fresh_data['soc_id'] ?? null;
    $total_ht = $fresh_data['total_ht'] ?? null;
    $first_proposal_total_ht = $fresh_data['first_proposal_total_ht'] ?? null;
    $total_proposals_ht = $fresh_data['total_proposals_ht'] ?? null;
    $total_proposals_valid_ht = $fresh_data['total_proposals_valid_ht'] ?? null;
    $first_order = $fresh_data['first_order'] ?? null;
    $first_order_total_ht = $fresh_data['first_order_total_ht'] ?? null;
    $total_orders_ht = $fresh_data['total_orders_ht'] ?? null;
    $first_invoice = $fresh_data['first_invoice'] ?? null;
    $first_invoice_total_ht = $fresh_data['first_invoice_total_ht'] ?? null;
    $total_invoices_ht = $fresh_data['total_invoices_ht'] ?? null;
    
    // Construire les données à envoyer à Pipedrive
    $pipedrive_data = [];
    
    // Mettre à jour le titre avec le nom + type d'événement
    if ($name && $object_type) {
        $pipedrive_data['title'] = $name . ' - ' . $object_type;
    }
    
    // Mettre à jour la valeur du deal avec total_ht
    if ($total_ht !== null && floatval($total_ht) > 0) {
        $pipedrive_data['value'] = floatval($total_ht);
        $pipedrive_data['currency'] = 'EUR';
    }
    
    // Si c'est un devis signé, on peut marquer le deal comme gagné
    if ($object_type === 'PROPAL_CLOSE_SIGNED') {
        $pipedrive_data['status'] = 'won';
        $pipedrive_data['won_time'] = date('Y-m-d\TH:i:s\Z');
    }
    
    // Champs personnalisés - INFO DEVIS 1
    $custom_fields = [];
    
    // 01 - Lien du Devis (TODO: à compléter avec les vraies données Fresh)
    $lien_devis = $fresh_data['lien_devis'] ?? "https://atelier-gambetta.crm.freshprocess.eu/comm/propal/card.php?id={$object_id}";
    $custom_fields[$FIELD_LIEN_DEVIS] = $lien_devis;
    
    // 02 - Ref
    if ($object_ref) {
        $custom_fields[$FIELD_REF] = $object_ref;
    }
    
    // 03 - Montant HT (format monetary: objet avec value et currency)
    $montant_devis = $first_proposal_total_ht ?? $total_proposals_valid_ht ?? $total_ht;
    if ($montant_devis !== null && floatval($montant_devis) > 0) {
        $custom_fields[$FIELD_MONTANT_HT] = [
            'value' => floatval($montant_devis),
            'currency' => 'EUR'
        ];
    }
    
    // 04 - Statu (100 = VALIDÉ, 101 = BROUILLON)
    if ($object_type === 'PROPAL_VALIDATE' || $object_type === 'PROPAL_CLOSE_SIGNED') {
        $custom_fields[$FIELD_STATU] = 100; // VALIDÉ
    } else {
        $custom_fields[$FIELD_STATU] = 101; // BROUILLON
    }
    
    // 05 - Lien Signature (TODO: à compléter avec les vraies données Fresh)
    $lien_signature = $fresh_data['lien_signature'] ?? "https://atelier-gambetta.crm.freshprocess.eu/signature/{$object_id}";
    $custom_fields[$FIELD_LIEN_SIGNATURE] = $lien_signature;
    
    // 06 - Date fin Validité (TODO: à compléter avec les vraies données Fresh)
    // Format attendu: YYYY-MM-DD
    $date_fin_validite = $fresh_data['date_fin_validite'] ?? date('Y-m-d', strtotime('+30 days'));
    $custom_fields[$FIELD_DATE_FIN_VALIDITE] = $date_fin_validite;
    
    // Lien vers l'opportunité Fresh Process
    $lien_fresh = "https://atelier-gambetta.crm.freshprocess.eu/projet/card.php?id={$project_id}";
    $custom_fields[$FIELD_LIEN_FRESH] = $lien_fresh;
    
    // GCLID
    if ($gclid) {
        $custom_fields[$FIELD_GCLID] = $gclid;
    }
    
    // Synchronisation : 321 = Données traitées ✅
    $custom_fields[$FIELD_SYNC] = 321;
    
    // Ajouter les champs personnalisés à la requête
    if (!empty($custom_fields)) {
        $pipedrive_data['custom_fields'] = $custom_fields;
    }
    
    // Log pour debug
    $notes = "=== Mise à jour FreshProcess ({$object_type}) ===\n";
    $notes .= "Date: " . date('Y-m-d H:i:s') . "\n";
    $notes .= "Ref: {$object_ref}\n";
    $notes .= "Project ID: {$project_id}\n";
    $notes .= "Société: {$name} (ID: {$soc_id})\n";
    $notes .= "Montant HT: {$montant_devis} €\n";
    $notes .= "Total commandes HT: {$total_orders_ht} €\n";
    $notes .= "Total factures HT: {$total_invoices_ht} €\n";
    $notes .= "GCLID: {$gclid}\n";
    
    // Appel API Pipedrive v2 pour mettre à jour le deal
    $url = "https://api.pipedrive.com/api/v2/deals/{$deal_id}";
    
    $response = wp_remote_request($url, [
        'method'  => 'PATCH',
        'timeout' => 20,
        'headers' => [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
            'x-api-token'  => $api_token,
        ],
        'body' => json_encode($pipedrive_data),
    ]);
    
    if (is_wp_error($response)) {
        return [
            'success' => false,
            'error' => $response->get_error_message(),
        ];
    }
    
    $response_body = json_decode(wp_remote_retrieve_body($response), true);
    $response_code = wp_remote_retrieve_response_code($response);
    
    // Ajouter une note au deal avec les détails
    add_note_to_pipedrive_deal($deal_id, $notes, $api_token);
    
    return [
        'success' => $response_code >= 200 && $response_code < 300,
        'response_code' => $response_code,
        'data_sent' => $pipedrive_data,
        'pipedrive_response' => $response_body,
    ];
}

/**
 * Ajoute une note à un deal Pipedrive
 */
function add_note_to_pipedrive_deal($deal_id, $content, $api_token) {
    $url = "https://api.pipedrive.com/v1/notes";
    
    $note_data = [
        'deal_id' => $deal_id,
        'content' => $content,
        'pinned_to_deal_flag' => 0,
    ];
    
    $response = wp_remote_post($url . '?api_token=' . $api_token, [
        'timeout' => 20,
        'headers' => [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($note_data),
    ]);
    
    return !is_wp_error($response);
}

/**
 * Route pour lister tous les champs personnalisés des deals Pipedrive
 * Accès : /wp-json/egp/v1/pipedrive-fields
 */
add_action('rest_api_init', function () {
    register_rest_route('egp/v1', '/pipedrive-fields', [
        'methods'  => 'GET',
        'callback' => 'get_pipedrive_deal_fields',
        'permission_callback' => '__return_true',
    ]);
});

function get_pipedrive_deal_fields() {
    $api_token = 'dc709fbe3e1fc31fa63a75c0e4099d928afd39ca';
    $url = "https://api.pipedrive.com/v1/dealFields?api_token={$api_token}";
    
    $response = wp_remote_get($url, [
        'timeout' => 20,
        'headers' => [
            'Accept' => 'application/json',
        ],
    ]);
    
    if (is_wp_error($response)) {
        return new WP_REST_Response(['error' => $response->get_error_message()], 500);
    }
    
    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    // Filtrer pour n'afficher que les champs personnalisés (custom fields)
    $custom_fields = [];
    if (!empty($body['data'])) {
        foreach ($body['data'] as $field) {
            // Les champs personnalisés ont une clé qui est un hash
            if (strlen($field['key']) > 20) {
                $custom_fields[] = [
                    'name' => $field['name'],
                    'key' => $field['key'],
                    'field_type' => $field['field_type'],
                    'options' => $field['options'] ?? null,
                ];
            }
        }
    }
    
    return new WP_REST_Response([
        'success' => true,
        'custom_fields' => $custom_fields,
    ], 200);
}