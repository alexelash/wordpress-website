<?php
/**
 * Template part for displaying PROJECT content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alex Lash Design
 */

?>
	<header class="entry-header">
		<?php 
			$project_title = the_title(NULL,NULL,false);
			$project_subtitle = get_field('subtitle',$post->ID);
			$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'full')[0];

			echo "<div class='entry-header-container' style='background-image: url($featured_img);'>";
				echo "<div class='entry-title-container'>";
					echo "<h2 class='entry-title'>$project_title</h2>";
					echo "<h3 class='entry-subtitle'>$project_subtitle</h3>";
				echo "</div>";
			echo "</div>";
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			$row_num = 0;
			if( have_rows('project_rows') ) {
				while ( have_rows('project_rows') ) : the_row();
					echo "<div class='row'>";
						if( get_row_layout() == 'image_block' ) {
							$images = get_sub_field('images');
							$i_num = 0;
							foreach ($images as $i) {
								$i_url = $i['url'];
								$i_width = $i['width'];
								$i_height = $i['height'];

								echo "<div id='image-$i_num' class='image-container' style='background-image:$i_url;'>";
									echo "<img class='loader-image' src='$i_url' width='$i_width' height='$i_height'/>";
								echo "</div>";

								$i_num++;
							}
						}
						if( get_row_layout() == 'text_block' ) {
							$body_text = get_sub_field('body');

							echo $body_text;
						}
						if( get_row_layout() == 'callout_block' ) {
							$callout_text = get_sub_field('callout');

							echo $callout_text;
						}
						if( get_row_layout() == 'credits_block' ) {
							// if 
						}
					echo "</div>"; // End Row Div

					$row_num++;
				endwhile;
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<nav class="pages-navigation">
			<?php 
				echo "<a class='page-navigation nav-previous' href='";
					siblings('before');
				echo "'>Previous</a>";
				echo "<a class='page-navigation nav-next' href='";
					siblings('after');
				echo "'>Next</a>";
				//edit_post_link( esc_html__( 'Edit', 'alex-lash-design' ), '<span class="edit-link">', '</span>' ); 
			?>
		</nav>
	</footer><!-- .entry-footer -->

