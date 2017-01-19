<?php
//$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
//$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
//echo $color;
?>

<div class="hero hero--gradient">

<!-- Logo -->
<a href="<?php echo home_url(); ?>" class="page-header__href hide-on-desktop" data-logo >
    <svg class="icon page-header__icon">
      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape-squie" viewBox="0 0 32 32"></use>
    </svg>
</a>

    <div class="hero__content">
        <h1 class="hero__title" data-hero-title >
            <span class="hero__word inro-ani">Digital</span>
            <span class="hero__word inro-ani">Creative</span>
            <span class="hero__word inro-ani">Collaboration.</span>

            <span class="hero__word inro-ani">
                <?php include('chevron.php') ?>
            </span>
            <!--
              <span class="hero__word">Digital</span>
              <span class="hero__word">UX,</span>
              <span class="hero__word">UI</span>
              <span class="hero__word">design</span>
              <span class="hero__word">and</span>
              <span class="hero__word">front-end</span>
              <span class="hero__word">development</span>
            -->
        </h1>



    </div>

</div>
