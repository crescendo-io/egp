<?php
/* Template Name: Page Produit */
get_header();

$product_price = get_field('product_price');
$product_intro = get_field('product_intro');
$product_image = get_field('product_image');
$product_embed = get_field('product_embed');

$product_price_json = preg_replace('/[^0-9]/', '', $product_price);

if($product_image){
    $product_image_array = get_custom_thumb($product_image, 'full');
}
?>

<div class="loader-form">
    <div id="loader">
        <div class="spinner"></div>
    </div
</div>
<div class="introduction-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <?php if($product_image_array): ?>
                <div class="container-img-introduction">
                    <div class="image-item">
                        <img src="<?= $product_image_array['url']; ?>" width="<?= $product_image_array['width']; ?>" height="<?= $product_image_array['height']; ?>" alt="<?= $product_image_array['alt']; ?>" loading="lazy">
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6">
                <div class="container-pricing-product">
                    <div class="hero-product">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="title-product"><?= get_the_title(); ?></h1>
                                <p><?= $product_intro; ?></p>
                            </div>
                            <div class="col-sm-4 text-right">
                                <?php if($product_price): ?>
                                <div class="price">à partir de <div class="price-value"><?= $product_price; ?></div></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <form id="upload-image-form" enctype="multipart/form-data">
                        <label>
                            Nom de la société *
                            <input type="text" name="society-name" required>
                        </label>
                        <label>
                            Adresse complète de votre société *
                            <input type="text" name="society-address" required>
                        </label>
                        <label>
                            Adresse de votre projet (si différente)
                            <input type="text" name="project-address">
                        </label>
                        <label>
                            Votre Prénom *
                            <input type="text" name="first-name" required>
                        </label>
                        <label>
                            Votre Nom *
                            <input type="text" name="second-name" required>
                        </label>
                        <label>
                            Votre Email *
                            <input type="email" name="email" required>
                        </label>
                        <label>
                            Numéro de portable *
                            <input type="tel" name="phone" required>
                        </label>
                        <label>
                            Description du projet
                            <textarea name="description" id="" cols="30" rows="10"></textarea>
                        </label>

                        <label>
                            Ajouter jusqu'à 3 images<br/>
                            <span style="font-size: 10px">(Seuls les fichiers JPG, PNG, GIF et PDF sont autorisés.) <strong>5Mo maximum</strong></span>
                            <input type="file" name="images[]" id="images" accept="image/*,.pdf" multiple>
                        </label>

                        <span style="font-size: 12px">Si vous souhaitez insérer plus de pièces jointes, vous pouvez nous les envoyer sur <a href="mailto:contact@ateliergambetta.com" style="text-decoration: underline">contact@ateliergambetta.com</a></span>
                        <br/>
                        <br/>

                        <div id="message"></div>

                        <button type="submit" class="button">Envoyer</button>
                    </form>

                    <div id="message"></div>

                    <script>
                        let fileValidationError = false; // ❗ variable globale pour bloquer le submit si erreur

                        document.getElementById("images").addEventListener("change", function () {
                            let files = this.files;
                            let maxSize = 5 * 1024 * 1024; // 5 Mo
                            let allowedTypes = ["image/jpeg", "image/png", "image/gif", "application/pdf"];
                            let errorMessages = [];

                            document.getElementById("message").innerHTML = ""; // reset

                            // Vérifier le nombre de fichiers
                            if (files.length > 3) {
                                errorMessages.push("Vous ne pouvez envoyer que 3 fichiers maximum.");
                            }

                            for (let i = 0; i < files.length; i++) {
                                let file = files[i];

                                if (!allowedTypes.includes(file.type)) {
                                    errorMessages.push(`Le fichier n'est pas autorisé.`);
                                }

                                if (file.size > maxSize) {
                                    errorMessages.push(`Le fichier dépasse la taille maximale de 5 Mo.`);
                                }
                            }

                            if (errorMessages.length > 0) {
                                this.value = ""; // reset l'input file
                                document.getElementById("message").innerHTML = "<p style='color:red;'>" + errorMessages.join("<br>") + "</p>";
                                fileValidationError = true; // 🚫 blocage
                            } else {
                                fileValidationError = false; // ✅ autorisé
                            }
                        });

                        document.addEventListener("DOMContentLoaded", function () {
                            document.getElementById("upload-image-form").addEventListener("submit", function (e) {
                                e.preventDefault();

                                // ⚠️ Vérifie s’il y a une erreur côté fichier avant d’aller plus loin
                                if (fileValidationError) {
                                    document.getElementById("message").innerHTML = "<p style='color:red;'>Veuillez corriger les erreurs de fichiers avant de soumettre le formulaire.</p>";
                                    return;
                                }

                                $('.loader-form #loader').addClass('visible');
                                $('#upload-image-form button[type="submit"]').attr('disabled', 'disabled');

                                let fileInput = document.getElementById("images");
                                let files = fileInput.files;
                                let maxSize = 5 * 1024 * 1024; // 5 Mo en octets
                                let allowedTypes = ["image/jpeg", "image/png", "image/gif", "application/pdf"];
                                let errorMessages = [];

                                // Vérifier le nombre de fichiers
                                if (files.length > 3) {
                                    errorMessages.push("Vous ne pouvez envoyer que 3 fichiers maximum.");
                                }

                                for (let i = 0; i < files.length; i++) {
                                    let file = files[i];

                                    // Vérifier le type MIME
                                    if (!allowedTypes.includes(file.type)) {
                                        errorMessages.push(`Le fichier n'est pas autorisé.`);
                                    }

                                    // Vérifier la taille du fichier
                                    if (file.size > maxSize) {
                                        errorMessages.push(`Le fichier dépasse la taille maximale de 5 Mo.`);
                                    }
                                }

                                if (errorMessages.length > 0) {
                                    document.getElementById("message").innerHTML = "<p style='color:red;'>" + errorMessages.join("<br>") + "</p>";
                                    fileValidationError = true;
                                    return;
                                } else {
                                    fileValidationError = false;
                                }

                                // Si tout est bon, on envoie le formulaire
                                let formData = new FormData(this);
                                formData.append("action", "add_opportunity");

                                fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                                    method: "POST",
                                    body: formData,
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        window.location.replace('<?php echo get_site_url(); ?>/demande-de-devis/confirmation-demande/');
                                    })
                                    .catch(error => {
                                        window.location.replace('<?php echo get_site_url(); ?>/demande-de-devis/confirmation-demande/');
                                    });
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $product_slider = get_field('product_slider');

    if($product_slider):
?>

<div class="slider-introduction-product">
    <div class="swiper" data-itemsdesk="1" data-itemstablet="1" data-itemsmobile="1">
        <div class="swiper-wrapper">
            <?php
            foreach ($product_slider as $product_slider_item):
                $contentSlideText = $product_slider_item['product_slider_text'];
                $contentSlideImg = $product_slider_item['product_slider_image'];
                $contentSlideImgArray = '';
                if($contentSlideImg){
                    $contentSlideImgArray = get_custom_thumb($contentSlideImg, 'full');
                }
            ?>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="container-text-slide">
                                    <?= $contentSlideText; ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <?php if($contentSlideImgArray): ?>
                                <div class="container-image-slide">
                                    <img src="<?= $contentSlideImgArray['url']; ?>" width="<?= $contentSlideImgArray['width']; ?>" height="<?= $contentSlideImgArray['height']; ?>" alt="<?= $contentSlideImgArray['alt']; ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php endif; ?>

<?php if( have_rows('page') ):
    while ( have_rows('page') ) : the_row();
        get_template_part('template-parts/strates/' . get_row_layout());
    endwhile;
endif; ?>


<?php
$products_items = get_field("product_link");

if($products_items):
?>

    <div class="cross-linkin">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="title-cross">Ces produits peuvent vous intéresser</h2>
                </div>

                <?php
                    foreach ($products_items as $product_item) :
                        $postID = $product_item;
                        $product_title = get_the_title($postID);
                        $product_link = get_the_permalink($postID);
                        $product_price = get_field('product_price', $postID);
                        $product_intro = get_field('product_intro', $postID);
                        $product_image = get_field('product_image', $postID);

                        if($product_image){
                            $product_image_array = get_custom_thumb($product_image, '600_600');
                        }
                ?>

                    <div class="col-sm-3">
                        <a href="<?= $product_link; ?>" class="article-linked">
                            <?php if($product_image_array): ?>
                            <img src="<?= $product_image_array['url']; ?>" width="<?= $product_image_array['width']; ?>" height="<?= $product_image_array['height']; ?>" alt="<?= $product_image_array['alt']; ?>" loading="lazy">
                            <?php endif; ?>
                            <h3>
                                <?= $product_title; ?>
                            </h3>
                            <p>
                                <?= $product_intro; ?>
                            </p>
                            <div class="row princing">
                                <div class="col-sm-8">
                                    <div class="button secondary">
                                        découvrir
                                    </div>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <p>à partir de <strong><?= $product_price; ?></strong></p>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>


            </div>
        </div>
    </div>

<?php
endif;
?>


<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "<?= get_the_title(); ?>",
        "description": "<?= $product_intro; ?>",
        "image": [
            "<?= $product_image_array['url']; ?>"
        ],
        "brand": {
            "@type": "Brand",
            "name": "Atelier Gambetta"
        },
        "offers": {
            "@type": "Offer",
            "price": "<?= $product_price_json; ?>",
            "priceCurrency": "EUR",
            "availability": "https://schema.org/InStock",
            "url": "<?= get_the_permalink(); ?>"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.5",
            "reviewCount": "23"
        }
    }
</script>




<?php get_footer();
