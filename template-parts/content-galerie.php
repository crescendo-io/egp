<?php
    $galerie_photo = get_field('galerie_photo');

    if($galerie_photo){
        $galerie_photo_array = get_custom_thumb($galerie_photo, 'full');
    }
?>
<article id="post-<?php the_ID(); ?>" class="post-galerie col-sm-3">
    <header class="entry-header">
        <?php if ($galerie_photo) : ?>
            <a href="<?= $galerie_photo_array['url']; ?>"  data-lightbox="lightbox" title="<?php the_title_attribute(); ?>">
                <img src="<?= $galerie_photo_array['url']; ?>" width="<?= $galerie_photo_array['width']; ?>" height="<?= $galerie_photo_array['height']; ?>" class="img-galerie" alt="<?= $galerie_photo_array['alt']; ?>" loading="lazy">
                <div class="entry-title">
                    <?php the_title(); ?>

                    <div class="sub-info">
                        <span class="posted-on">
                            <?php echo __('Published on:', 'textdomain') . ' ' . get_the_date(); ?>
                        </span>

                    </div>
                </div>
            </a>
        <?php endif; ?>
    </header><!-- .entry-header -->


</article><!-- #post-<?php the_ID(); ?> -->
