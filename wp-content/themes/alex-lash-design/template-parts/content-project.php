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
			$page_color = get_field('page_color',$post->ID);
			$text_color = get_field('text_color',$post->ID);
			$featured_img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'full')[0];
			$featured_img_location = get_posts(array('p' => get_post_thumbnail_id( $post->ID ), 'post_type' => 'attachment'))[0]->post_content;
			$featured_img_size = get_posts(array('p' => get_post_thumbnail_id( $post->ID ), 'post_type' => 'attachment'))[0]->post_excerpt;

			echo "<div class='entry-header-container' style='background-image: url($featured_img); background-position: $featured_img_location; background-size: $featured_img_size; '>";
				echo "<div class='entry-title-container'>";
					echo "<h2 class='entry-title'>$project_title</h2>";
					echo "<h3 class='entry-subtitle'>$project_subtitle</h3>";
				echo "</div>";
			echo "</div>";
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			echo "<div class='entry-information'>";
				echo "<div class='entry-description'>";
					echo get_the_content();
				echo "</div>";
				echo "<aside class='entry-details'>";
					$direct_url = get_field('external_url',$post->ID);
					$ext_link = file_get_contents(locate_template('SVGs/inline-ext_link.svg.php'));

					echo "<h4>Role in Project</h4>";
					echo implode(', ', get_field('role'));

					if( have_rows('credits_rows') ) {
						echo "<ul class='credits-list'>";
						while( have_rows('credits_rows') ): the_row();
							echo "<li class='credits-list-item'>";
							if( get_row_layout() == 'art_direction' ) {
								$link = get_sub_field('link');
								$displayTitle = get_sub_field('art_director');
								$ext_link = $link!=''?file_get_contents(locate_template('SVGs/inline-ext_link.svg.php')):'';

								echo "<h4>Art Director</h4>";
								echo "<a class='col_right' href='$link' target='_blank' title='$displayTitle'>$displayTitle $ext_link</a>";
							}	
							if( get_row_layout() == 'photography' ) {
								$link = get_sub_field('link');
								$displayTitle = get_sub_field('photographer');

								echo "<h4>Photographer</h4>";
								echo "<a class='col_right' href='$link' target='_blank' title='$displayTitle'>$displayTitle $ext_link</a>";
							}	
							if( get_row_layout() == 'recognition' ) {
								$displayTitle = get_sub_field('award');

								echo "<h4>Recognition</h4>";
								echo "<div class='col_right'>$displayTitle</div>";
							}		
							if( get_row_layout() == 'design' ) {
								$displayTitle = get_sub_field('designer');
								$link = get_sub_field('link');

								echo "<h4>Designer</h4>";
								echo "<a class='col_right' href='$link' target='_blank' title='$displayTitle'>$displayTitle $ext_link</a>";
							}								
							echo "</li>";
	   				endwhile;
	    			echo "</ul>";
	   			}

	   			if ($direct_url!='') {
	   				echo "<hr style='background-color:$text_color'>";
	   				echo "<a class='col_right website-link' target='_blank' href='$direct_url'>View website $ext_link</a>";
	   			}
				echo "</aside>";
			echo "</div>";



			$row_num = 0;
			if( have_rows('project_rows') ) {
				while ( have_rows('project_rows') ) : the_row();
					$row_type = get_row_layout();

					echo "<div class='row $row_type'>";
						if( get_row_layout() == 'image_block' ) {
							$images = get_sub_field('images');
							$images_count = count($images);

							echo "<div class='gallery gallery-columns-$images_count'>";
								$avg_ratio = 0;
								foreach ($images as $i) {
									$i_num = 0;
									$avg_ratio += $i['width']/$i['height'];
								}
								$avg_ratio = $avg_ratio/$images_count;
								foreach ($images as $i) {
									$i_url = $i['url'];
									$i_alt = $i['alt'];

									echo "<div class='gallery-item' style='background-color: $page_color;'>";
										echo "<div id='image-$i_num' class='image-container' style='background-image:url($i_url);'>";
											$margin_ratio = (1/$avg_ratio-1)*100;
											echo "<img class='loader-image' src='$i_url' width='$i_width' height='$i_height' style='display: none;' alt='$i_alt'/>";
											echo "<img class='proportion-image' style='margin-top:$margin_ratio%' src='data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'/>";
										echo "</div>";
									echo "</div>";
									$i_num++;
								}
							echo "</div>";
						}
						if( get_row_layout() == 'text_block' ) {
							$body_text = get_sub_field('body');

							echo $body_text;
						}
						if( get_row_layout() == 'callout_block' ) {
							$callout_text = get_sub_field('callout');

							echo $callout_text;
						}
					
					echo "</div>"; // End Row Div
					$row_num++;
				endwhile;
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<nav class="pages-navigation page_item">
			<?php 
				echo "<a class='page-navigation nav-previous' href='";
					siblings('before');
				echo "'>";
				?>
				<button class='arrow-button'>
					<div class="arrow-line arrow-a"></div>
					<div class="arrow-line arrow-c"></div>
					<div class="arrow-line arrow-b"></div>
				</button>
				<?php
				echo "Previous</a>";
				echo "<a class='page-navigation nav-next' href='";
					siblings('after');
				echo "'>Next";
				?>
				<button class='arrow-button'>
					<div class="arrow-line arrow-a"></div>
					<div class="arrow-line arrow-c"></div>
					<div class="arrow-line arrow-b"></div>
				</button>
				<?php
				echo "</a>";
				//edit_post_link( esc_html__( 'Edit', 'alex-lash-design' ), '<span class="edit-link">', '</span>' ); 
			?>
		</nav>
	</footer><!-- .entry-footer -->

