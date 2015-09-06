<?php
/**
 * The template for displaying all pages.
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

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
				global $post;
				$post_id = $post -> ID;
				$parent_id = wp_get_post_parent_id( $post_id );
				while ( have_posts() ) : the_post();
					if ($parent_id==7) get_template_part( 'template-parts/content', 'project' ); 
					else get_template_part( 'template-parts/content', 'page' ); 
				endwhile; // End of the loop. 
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
