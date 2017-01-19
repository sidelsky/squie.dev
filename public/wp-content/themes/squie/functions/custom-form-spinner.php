<?php

  function spinner_url($image_src, $form){
      return  get_bloginfo('template_directory') . '/assets/build/images/spinner.svg' ; // relative to you theme images folder
  }

  add_filter("gform_ajax_spinner_url", "spinner_url", 10, 2);

 ?>
