<?php 
/*
Template Name: Contact template
*/
get_header(); ?>
<section id="content" role="main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
      // Setup basic post data for the page
      $mainHeadline = get_field('headline');
      $mainContent = get_field('main_content');
      $featuredImagesBoolean = get_field('featured_images_boolean');
      $featuredImage1 = get_field('featured_image_1');
      $caption1 = get_field('caption_1');
      $featuredImage2 = get_field('featured_image_2');
      $caption2 = get_field('caption_2');
      // Flexible content is not stored in variables, but is rather performed as a loop within the page content below.
    ?>
    <header>
      <h1>
        <?php if ($mainHeadline) {
          echo $mainHeadline;
        } else {
          the_title();
        }
        ?>
      </h1>
      <div class="hr"></div>
    </header>

    <?php the_content(); ?>
  </article>

  <?php endwhile; endif; ?>

</section>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>