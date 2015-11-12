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
				'post_type'				=> 'page',
				'post_parent'			=> 7, // Work
				'post_per_page' 	=> -1,
				'orderby'					=> 'menu_order',
				'order'						=> 'asc'
			) );	

			while ( $projects->have_posts() ) : $projects->the_post();
				$title = get_the_title();
				$subtitle = strtolower(get_field('subtitle'));
				$page_color = get_field('page_color', $post->ID);
				$text_color = get_field('text_color', $post->ID);
				$page_link = get_the_permalink();
				$project_name = $post -> post_name;
				$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'full')[0];
				$featured_img_location = get_posts(array('p' => get_post_thumbnail_id( $post->ID ), 'post_type' => 'attachment'))[0]->post_content;
				$featured_img_size = get_posts(array('p' => get_post_thumbnail_id( $post->ID ), 'post_type' => 'attachment'))[0]->post_excerpt;

				echo "<li id='$project_name' class='project page_item'>";
					echo "<a href='$page_link' class='project-link' data-bgimg='$featured_img' data-bgcolor='$page_color' data-textcolor='$text_color' data-bglocation='$featured_img_location' data-bgsize='$featured_img_size'>";
						echo "<h2 class='project-title'>$title</h2>";
						echo "<h3 class='project-subtitle'>$subtitle</h2>";
					echo "</a>";
				echo "</li>";

			endwhile; wp_reset_query(); ?>
		</ul>
		<div class='preview'>
			<?php 
				while ( $projects->have_posts() ) : $projects->the_post();
					$project_name = $post -> post_name;
					echo "<div id='$project_name' class='preview-image'>";
						echo "<img id='$project_name' class='loader-image' src=''>";
					echo "</div>";
				endwhile; wp_reset_query(); 
			?>
		</div>
	</main><!-- #main -->
<?php get_footer(); ?>
