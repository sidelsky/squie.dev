<?php include("header.php"); ?>
	
	<section role="main">
	
		<?php if (have_posts()): the_post(); ?>
		
			<h2>Posts by: <?php echo get_the_author(); ?></h2>
			
			<?php if (get_the_author_meta('description')) {
			
				the_author_meta('description');
				
			}
			rewind_posts(); while (have_posts()) : the_post(); ?>
			
			<article>
		
				<header>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<p class="date"><?php the_time('F j, Y'); ?></p>
				<p class="excerpt"><?php the_excerpt(); ?></p>
				
			</article>
			
		<?php endwhile; endif; ?>
		
	</section>

<?php include("footer.php"); ?>