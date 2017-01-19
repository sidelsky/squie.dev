<?php include("header.php"); ?>
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		
		<article>
			
			<header>
				<h2><?php the_title(); ?></h2>
			</header>
			
			<p class="date"><?php the_time('F j, Y'); ?></p>
			
			<p class="author"><?php the_author_posts_link(); ?></p>
			
			<ul class="categories">
				<?php wp_list_categories(array("title_li" => "")); ?>
			</ul>
			
			<?php the_content(); ?>
			
		</article>
	
	<?php endwhile; endif; ?>
	
<?php include("footer.php"); ?>