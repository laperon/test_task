<?php get_header(); ?>
	<div class="container">
		<div class="pub-wrapper">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="post">
					<div class="image">
						<?php echo Helper::the_attachment_image( get_the_ID() ); ?>
					</div>
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>