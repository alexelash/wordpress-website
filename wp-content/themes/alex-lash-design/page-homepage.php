<?php
/**
 * Template Name: Homepage Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alex Lash Design
 */

get_header(); ?>
	<main id="main" class="site-main" role="main">
		<ul class="projects">
		<?php 
			$projects = new WP_Query( array(
				'post_type'				=> 'pages',
				'post_parent'			=> 7, // Work
				'post_per_page' 	=> 15,
				'orderby'					=> 'menu_order'
				));	

			while ( $projects->have_posts() ) : $projects->the_post();
			$title = get_the_title();
			$subtitle = get_field('subtitle');
			$page_link = get_the_permalink();

			echo "<li class='project'>";
				echo "<a href='$page_link' class='project-link' data-bgimg=''>";
					echo "<h2 class='project-title'>$title</h2>";
					echo "<h3 class='project-subtitle'>$subtitle</h2>";
				echo "</a>";
			echo "</li>";

			endwhile; wp_reset_query(); ?>
		</ul>
	</main><!-- #main -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
