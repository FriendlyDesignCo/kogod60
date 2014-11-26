<?php get_header(); ?>

				<!-- BEGIN TIMELINE -->

				<section id="timeline" class="container" role="main">

					<menu class="filter container">
						<div>
							<h6>Explore 60<br class="mobileBreak" /> years of:</h6>
							<ul>
								<li class="toggle"><a>View All</a></li>
								<div class="hide">
									<li><a data-category="milestones">Milestones</a></li>
									<li><a data-category="pioneering-education">Pioneering Education</a></li>
									<li><a data-category="people-of-kogod">People of Kogod</a></li>
									<li><a class="active" data-category="view-all">View All</a></li>
								</div>
							</ul>
							<div class="clearfix"></div>
						<div>
					</menu>

					<div class="timelineHolder">
						<div class="columnSizer"></div>
						<?php
						//
						//	DEFINE WP_QUERY TO GRAB TIMELINE EVENT POSTS
						//
						$query = new WP_Query(array(
							'post_type' => 'timeline-events',
							'order' => 'ASC'
						)); ?>

					<?php if ( $query->have_posts() ) : 
						$i = 1;
					?>
					<!-- the loop -->
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<article class="event visible <?php echo 'vis-' . $i; ?> <?php $categories = get_the_category(); foreach($categories as $category) { echo $category->slug . ' '; } ?>">
						<header>
							<?php if (get_field('timeline_image')) {
								$image = get_field('timeline_image'); ?>
								<a href="<?php the_permalink(); ?>">
									<img class="event__image" src="<?php echo $image['sizes']['large']; ?>" />
								</a>
							<?php } ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<h4><?php echo get_the_date('Y'); ?></h4>
						</header>
						<div class="clearfix"></div>
						<?php if (get_field('event_description_short')) { ?>
						<p><?php echo get_field('event_description_short'); ?></p>
						<p><a href="<?php the_permalink(); ?>">Learn more</a></p>
						<?php } ?>
					</article>

					<?php 
						$i++;
					endwhile; ?>
					<!-- end of the loop -->


					<?php wp_reset_postdata(); ?>

					<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>

					</div> <!-- .timelineHolder -->

					<div class="clearfix"></div>
					<a class="button" href="<? bloginfo('url'); ?>/events/">Learn more about 60th Events and&nbsp;Opportunities</a>
				</section> <!-- #timeline.container -->

				<!-- END TIMELINE -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>