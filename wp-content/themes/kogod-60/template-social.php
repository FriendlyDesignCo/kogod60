<?php 
/*
Template Name: Social template
*/
get_header(); ?>
<section id="content" role="main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header>
      <h1><?php the_title(); ?>
      </h1>
      <div class="hr"></div>
    </header>

    <section class="social-feed">
      <div class="tagboard-embed" tgb-slug="KogodAt60/200955"></div> 
      <script src="https://tagboard.com/public/js/embed.js"></script> 
    </section> <!-- .social-feed -->
  </article>

  <?php endwhile; endif; ?>

</section>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>