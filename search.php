<?php
/**
 * The template for displaying search results pages.
 *
 * @package Zeit Online Blogs Twentyeighteen
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'zb' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */
			$counter = 1;
			?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				?>

				<!-- template-parts/content.php -->
				<article id="post-<?php the_ID(); ?>" class="teaser-big">
					<header class="entry-header">
				  	<?php if ( 'post' == get_post_type() ) : ?>
						<div class="teaser-big__entry-meta">
							<?php zb_posted_on( 'long' ); ?>
						</div><!-- .entry-meta -->
						<?php endif; ?>
						<?php the_title( sprintf( '<h2 class="teaser-big__entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					</header><!-- .entry-header -->
				  <?php //the_post_thumbnail(); ?>
					<div class="teaser-big__entry-content">
						<?php zb_search_excerpt_highlight(); ?>

						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zb' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<footer class="teaser-big__entry-footer">
						<?php zb_posted_by(); ?><?php zb_entry_footer(', '); ?>
					</footer><!-- .entry-footer -->
					<div class="horizontal-line">&nbsp;</div>
				</article><!-- #post-## -->

				<?php
				if( $counter == 2) {
  					get_template_part( 'template-parts/ads', 'tile7' );
				}
				$counter++;
				?>

			<?php endwhile; ?>

			<?php zb_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
