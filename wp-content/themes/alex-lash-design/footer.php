<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alex Lash Design
 */

?>

	<footer class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php 
				if (have_rows('social_media_icons', 'option'); {
					echo "<ul class='social-media-links'>";
					while ( have_rows('social_media_icons') ) : the_row();
						$title = get_sub_field('display_title');
						$link = get_sub_field('external_link');

						echo "<li class='social-media-link'>";
							echo "<a href='$link'>$title</a>";
						echo "</li>";
			    endwhile;
					echo "</ul>";
				}
			?>

			<div class="email_address">
				
			</div>
			<div class="insert-quirky-statement-here"></div>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
