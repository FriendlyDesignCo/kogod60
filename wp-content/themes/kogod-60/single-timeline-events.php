<?php get_header(); ?>
<section id="content" role="main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
      // Setup basic post data for the page
      $description = get_field('event_description_long');
      $featuredImagesBoolean = get_field('featured_images_boolean');
      $featuredImage1 = get_field('featured_image_1');
      $caption1 = get_field('caption_1');
      $featuredImage2 = get_field('featured_image_2');
      $caption2 = get_field('caption_2');
      // Flexible content is not stored in variables, but is rather performed as a loop within the page content below.
    ?>
    <header>
      <h4><?php the_date('Y'); ?></h4>
      <h1><?php the_title(); ?></h1>
    </header>

    <nav class="pagination">
      
      <ul>
        <li class="prev"><?php previous_post_link('%link', '&laquo; Previous<span> Event</span>'); ?></li>
        <li><a href="<?php bloginfo('url'); ?>">Back to Timeline</a></li>
        <li class="next"><?php next_post_link('%link', 'Next <span>Event </span>&raquo;'); ?></li>
      </ul>
    </nav>

    <section class="description<?php if ($featuredImagesBoolean ==='Yes') { echo ' hasImages'; } else { echo ' noImages'; } ?>">
      <div class="description__text">
        <?php echo $description; ?>
      </div>
      <?php if ($featuredImagesBoolean === 'Yes') { ?>
        <div class="description__images">
          <div class="image">
            <img src="<?php echo $featuredImage1['sizes']['large']; ?>" />
            <?php if ($caption1) { ?>
            <p><?php echo $caption1; ?></p>
            <?php } ?>
          </div>
          <?php if ($featuredImage2) { ?>
          <div class="image">
            <img src="<?php echo $featuredImage2['sizes']['large']; ?>" />
            <?php if ($caption2) { ?>
            <p><?php echo $caption2; ?></p>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      <?php } ?>
      <div class="clearfix"></div>
    </section>

    <!-- Video/Image Gallery flexible content area -->
    <?php 
    if( have_rows('flexible_content') ):
      // loop through the rows of data
      while ( have_rows('flexible_content') ) : the_row();
        if( get_row_layout() == 'video' ):
    ?>
    <div class="hr trans"></div>
    <section class="video">
      <header>
        <h4><?php the_sub_field('title'); ?></h4>
      </header>
      <?php 
        // Embed video on page via Jetpack plugin shortcode
        $videoURL = get_sub_field('video_url');
        $vimeo = strpos($videoURL, 'vimeo');
        $youtube = strpos($videoURL, 'youtube');
        if ($vimeo !== false) {
          echo do_shortcode('[vimeo ' . $videoURL .']');
        }
        if ($youtube !== false) {
          echo do_shortcode('[youtube ' . $videoURL .']');
        }
      ?>
    </section>
    <?php 
        elseif( get_row_layout() == 'image_gallery' ):
    ?>
    <div class="hr trans"></div>
    <section class="gallery">
      <header>
        <h4><?php the_sub_field('title'); ?></h4>
      </header>
      <div>
        <?php 

        $images = get_sub_field('gallery');
        if( $images ): ?>
          <ul class="images">
            <?php foreach( $images as $image ): ?>
            <li>
              <a 
                href="<?php echo $image['url']; ?>"
                class="fresco"
                data-fresco-caption="<?php echo $image['caption']; ?>"
                data-fresco-group="photos">
                <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <div class="clearfix"></div>
      </div>
    </section>
    <?php
        endif;
      endwhile;
    else :
      // no layouts found
    endif;
    ?>
    <!-- End Video/Image Gallery flexible content area -->
  </article>

  <?php endwhile; endif; ?>

</section>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>