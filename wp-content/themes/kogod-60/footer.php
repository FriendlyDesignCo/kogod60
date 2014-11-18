	
			<footer id="footer" class="container" role="contentinfo">
					<div class="hr">
						<a class="logo" href="/"></a>
					</div>

					<div class="contact">
						<a href="http://www.american.edu/kogod/" class="auLogo"></a>
						<address>4400 Massachusetts Avenue, NW, Washington, DC 20016</address>
						<p><a href="tel:202-885-1000">(202) 885-1000</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Maps</a>
					</div> <!-- .contact -->

					<div class="meta">
						<nav id="site-nav" role="navigation">
							<!-- <a class="handle icon"></a> -->
							<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
						</nav>
						<p>&copy; <?php echo date('Y'); ?> American University.&nbsp;&nbsp;<a href="http://www.american.edu/oit/policies/Web-Copyright.cfm">Privacy</a> | <a href="http://www.american.edu/policies/disclosure.cfm">Disclosure</a> | <a href="https://www.american.edu/loader.cfm?csModule=security/getfile&pageid=3031888?">EEOC</a></p>
					</div> <!-- .meta -->
				<div class="clearfix"></div>
			</footer>
		
		</div>

		<?php wp_footer(); ?>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
		<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/twitter/jquery.tweet.js"></script> -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

	</body>
</html>