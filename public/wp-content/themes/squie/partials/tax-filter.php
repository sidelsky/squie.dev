<div class="controls" data-tax-filter-items>
    <?php
    $terms = get_terms('project_type', array(
        //'orderby'    => 'name',
        'order'             => 'DESC',
        ));
    $count = count($terms);
    echo '<button type="button" class="control button" data-filter="all">All</button>';
    if ( $count > 0 ){
        foreach ( $terms as $term ) {
            $termname = strtolower($term->name);
            $termname = str_replace(' ', '-', $termname);
            echo '<button type="button" class="control button" data-filter=".'.$termname.'">'.$term->name.'</button>';
        }
    }
    //echo '<li class="sort" data-sort="myorder:asc">Asc</li>';
    //echo '<li class="sort" data-sort="myorder:desc">Desc</li>';
    ?>
</ul>
