<?php
get_header();

$product_price = get_field('product_price');
$product_intro = get_field('product_intro');
$product_image = get_field('product_image');
$product_embed = get_field('product_embed');

if($product_image){
    $product_image_array = get_custom_thumb($product_image, 'full');
}
?>
<div class="introduction-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <?php if($product_image_array): ?>
                <div class="container-img-introduction">
                    <div class="image-item">
                        <img src="<?= $product_image_array['url']; ?>" width="<?= $product_image_array['width']; ?>" height="<?= $product_image_array['height']; ?>" alt="<?= $product_image_array['alt']; ?>">
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
                    <?php if($product_embed): ?>
                        <?= $product_embed; ?>
                    <?php endif; ?>
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
                                    <img src="<?= $contentSlideImgArray['url']; ?>" width="<?= $contentSlideImgArray['width']; ?>" height="<?= $contentSlideImgArray['height']; ?>" alt="<?= $product_image_array['alt']; ?>">
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
                            <img src="<?= $product_image_array['url']; ?>" width="<?= $product_image_array['width']; ?>" height="<?= $product_image_array['height']; ?>" alt="<?= $product_image_array['alt']; ?>">
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



<?php get_footer();
