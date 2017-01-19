<?php
  //   ___        _               _____                            _
  //  / __|  _ __| |_ ___ _ __   |_   _|_ ___ _____ _ _  ___ _ __ (_)___ ___
  // | (_| || (_-<  _/ _ \ '  \    | |/ _` \ \ / _ \ ' \/ _ \ '  \| / -_|_-<
  //  \___\_,_/__/\__\___/_|_|_|   |_|\__,_/_\_\___/_||_\___/_|_|_|_\___/__/
  //

  add_action('init', 'custom_taxonomies');

  //Return array of labels and arguments for custom taxonomy
  function create_custom_taxonomy($titleSingle, $titlePlural, $taxSlug) {

    //Empty array to store the labels and arguments
    $taxVars			=	array();

    //Labels for the new taxonomy
    $taxLabels			=	array(
      "name"              =>	_x( $titlePlural, "taxonomy general name" ),
      "singular_name"     =>	_x( $titleSingle, "taxonomy singular name" ),
      "search_items"      =>	__( "Search $titlePlural" ),
      "all_items"         =>	__( "All $titlePlural" ),
      "parent_item"       =>	__( "Parent $titleSingle" ),
      "parent_item_colon" =>	__( "Parent $titleSingle:" ),
      "edit_item"         =>	__( "Edit $titleSingle" ),
      "update_item"       =>	__( "Update $titleSingle" ),
      "add_new_item"      =>	__( "Add New $titleSingle" ),
      "new_item_name"     =>	__( "New $titleSingle Name" ),
      "menu_name"         =>	__( "$titleSingle" )
    );

    //Arguments
    $taxVars["args"] = array(
      "hierarchical"		=>	true,
      "labels"			=>	$taxLabels,
      "show_ui"			=>	true,
      "show_admin_column"	=>	true,
      "query_var"			=>	true,
      "rewrite"			=>	array( "slug" => "$taxSlug" )
    );

    //Return the array
    return $taxVars;

  }

  //Set all of the taxonomies
  function custom_taxonomies() {

    $eventType = create_custom_taxonomy("Event Type", "Event Types", "event_type");
    register_taxonomy("event_type", array("event"), $eventType["args"]);

  }
?>
