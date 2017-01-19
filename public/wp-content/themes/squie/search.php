<?php include("header.php"); ?>
	
	<section role="main">
		
		<h2>Search results for: <?php echo get_search_query(); ?></h2>
		
		<?php get_template_part('loop'); ?>
	
	</section>
	
<?php include("footer.php"); ?>