<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article>
		
		<header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<p class="date"><?php the_time('F j, Y'); ?></p>
		<p class="excerpt"><?php the_excerpt(); ?></p>
		<p class="author"><?php the_author_posts_link(); ?></p>
		
		<!--<div class="centerItem">
			<?php the_post_thumbnail("custom-size"); ?>
			<div class="centerContent">
			
				<div class="wrapper">
					<div class="outer">
						<p>Lo-fi pop-up cupidatat, forage id meditation you probably haven't heard of them salvia.</p>
					</div>
				</div>
				
			</div>
		</div>-->
		
	</article>
	
<?php endwhile; else: ?>

	<article>
	
		<p class="error">Sorry, nothing to display</p>
		
	</article>

<?php endif; ?>