<?php 
/*
Template Name: Events template
*/
get_header(); ?>
<section id="content" role="main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
      // Setup basic post data for the page
      $eventsHeadline = get_field('events_section_headline');
      $involvedHeadline = get_field('get_involved_section_headline');
    ?>
    <section class="events">
      <header>
        <h1><?php echo $eventsHeadline; ?></h1>
        <div class="hr trans">
          <a class="button" href="#get-involved">Get Involved at Kogod</a>
        </div>
      </header>
      
      <div class="feedContainer">
        <div class="feed">
          <h4 class="feed__title">60<sup>th</sup> Anniversary Events</h4>
          
          <?php
            //
            //  DEFINE WP_QUERY TO GRAB ANNIVERSARY EVENT POSTS
            //
            $query = new WP_Query(array(
              'post_type' => 'anniversary-events',
              'meta_key' => 'event_date',
              'orderby' => 'meta_value_num',
              'order' => 'ASC'
            )); ?>

          <?php if ( $query->have_posts() ) : ?>

          <!-- the loop -->
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <article class="">
            <header>
              <?php 
                $date = DateTime::createFromFormat('Ymd', get_field('event_date'));
              ?>
              <div class="date">
                <span class="day"><?php echo $date->format('j'); ?></span>
                <span class="month"><?php echo $date->format('M'); ?></span>
              </div>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </header>
            <p><?php echo get_field('event_description_short'); ?></p>
            <div class="clearfix"></div>
          </article>
          <?php endwhile; ?>
          <!-- end of the loop -->


          <?php wp_reset_postdata(); ?>

          <?php else : ?>
          <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
          <?php endif; ?>
        </div>

        <div class="feed">
          <h4 class="feed__title">Kogod Signature Events</h4>
          
          <?php
            //
            //  DEFINE WP_QUERY TO GRAB SIGNATURE EVENT POSTS
            //
            $query = new WP_Query(array(
              'post_type' => 'signature-events',
              'meta_key' => 'event_date',
              'orderby' => 'meta_value_num',
              'order' => 'ASC'
            )); ?>

          <?php if ( $query->have_posts() ) : ?>

          <!-- the loop -->
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <article class="">
            <header>
              <?php 
                $date = DateTime::createFromFormat('Ymd', get_field('event_date'));
              ?>
              <div class="date">
                <span class="day"><?php echo $date->format('j'); ?></span>
                <span class="month"><?php echo $date->format('M'); ?></span>
              </div>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </header>
            <p><?php echo get_field('event_description_short'); ?></p>
            <div class="clearfix"></div>
          </article>
          <?php endwhile; ?>
          <!-- end of the loop -->


          <?php wp_reset_postdata(); ?>

          <?php else : ?>
          <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
          <?php endif; ?>
        </div>

        <div class="clearfix"></div>
      </div>
    </section> <!-- .events -->

    <section id="get-involved" class="getInvolved">
      <header>
        <h1><?php echo $involvedHeadline; ?></h1>
        <div class="hr trans"></div>
      </header>

      <!-- Video/Image Gallery flexible content area -->
      <?php 
      if( have_rows('get_involved_content_blocks') ):
        // loop through the rows of data
        while ( have_rows('get_involved_content_blocks') ) : the_row();
          if( get_row_layout() == 'headline_description_block' ):
      ?>
      <div class="contentBlock headline">
        <h4><?php echo get_sub_field('headline'); ?></h4>
        <?php the_sub_field('description'); ?>
      </div>
      <?php 
          elseif( get_row_layout() == 'way_to_get_involved_block' ):
      ?>
      <div class="contentBlock wayToGetInvolved">
        <?php if (get_sub_field('image')) {
          $image = get_sub_field('image');
        ?>
          <img class="thumbnail" src="<?php echo $image['sizes']['thumbnail']; ?>" />
        <?php } ?>
        <?php if (get_sub_field('url')) { ?>
          <h4>
            <a href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('headline'); ?></a>
          </h4>
        <?php } else { ?> 
          <h4><?php echo get_sub_field('headline'); ?></h4>
        <?php } ?>
        <div class="description">
          <?php the_sub_field('description'); ?>
        </div>
        <?php if (get_sub_field('url')) { ?>
          <a class="learnMore" href="<?php echo get_sub_field('url'); ?>">Learn more &raquo;</a>
        <?php } ?>
      </div>
      <?php
          endif;
        endwhile;
      else :
        // no layouts found
      endif;
      ?>
      <!-- End Video/Image Gallery flexible content area -->
      <div class="clearfix"></div>
    </section> <!-- .getInvolved -->

  </article>

  <?php endwhile; endif; ?>

</section>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>