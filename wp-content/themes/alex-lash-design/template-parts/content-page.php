<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alex Lash Design
 */
	$title = the_title(NULL,NULL,false);
	$pagename = $post -> name;
	$page_color = get_field('page_color',$post->ID);
	$text_color = get_field('text_color',$post->ID);
	$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'full')[0];
	$featured_img_location = get_posts(array('p' => get_post_thumbnail_id( $post->ID ), 'post_type' => 'attachment'))[0]->post_content;
	$featured_img_size = get_posts(array('p' => get_post_thumbnail_id( $post->ID ), 'post_type' => 'attachment'))[0]->post_excerpt;
?>
	<header class="entry-image">
	<?php 
			echo "<img id='$pagename-image' src='$featured_img'>";
	?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
		 echo "<div class='entry-description'>";
			echo get_the_content();
		echo "</div>"
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

