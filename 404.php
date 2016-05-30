<?php
/**
 * @package antonia
 */
get_header(); ?>
		<main>
			<section class="error-404">
				<header class="page-header">
					<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'antonia' ); ?></h1>
				</header>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'antonia' ); ?></p>
					<?php
						get_search_form();
						the_widget( 'WP_Widget_Recent_Posts' );
						// Only show the widget if site has multiple categories.
						if ( antonia_categorized_blog() ) :
					?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'antonia' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php
						endif;
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'antonia' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
						the_widget( 'WP_Widget_Tag_Cloud' );
					?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main>
<?php
get_footer();