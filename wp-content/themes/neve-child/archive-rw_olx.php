<?php get_header(); ?>
	<?php if( have_posts() ) : ?>
		<div class="posts-wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="post">
					<?php the_title( '<h1>' , '</h1>' ); ?>
				</div>
			<?php endwhile; ?>
		</div>
	<?php else: ?>
		<?php _e( 'Not posts found', 'neve' ); ?>
	<?php endif; ?>
<?php get_footer(); ?>
