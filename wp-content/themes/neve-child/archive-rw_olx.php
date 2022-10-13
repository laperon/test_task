<?php get_header(); ?>
    <div class="container">
		<?php if ( have_posts() ) : ?>
            <div class="pub-wrapper">
				<?php while ( have_posts() ) : the_post(); ?>
                    <div class="post">
                        <a href="<?php the_permalink(); ?>">
                            <div class="image">
		                        <?php echo Helper::the_attachment_image( get_the_ID() ); ?>
                            </div>
	                        <?php the_title( '<h1>', '</h1>' ); ?>
                        </a>
                    </div>
				<?php endwhile; ?>
            </div>
		<?php else: ?>
			<?php _e( 'Not posts found', 'neve' ); ?>
		<?php endif; ?>
    </div>
<?php get_footer(); ?>