<div class="controls" data-tax-filter-items data-tax-filter>
    <div class="controls__inner" data-tax-filter-inner>
        <?php
        $terms = get_terms('project_type', array(
            //'orderby'    => 'name',
            'order'             => 'DESC',
            ));
        $count = count($terms);
        echo '<button type="button" class="controls__button button" data-filter="all">All projects</button>';
        if ( $count > 0 ){
            foreach ( $terms as $term ) {
                $termname = strtolower($term->name);
                $termname = str_replace(' ', '-', $termname);
                echo '<button type="button" class="controls__button button" data-filter=".'.$termname.'">'.$term->name.'</button>';
            }
        }
        //echo '<li class="sort" data-sort="myorder:asc">Asc</li>';
        //echo '<li class="sort" data-sort="myorder:desc">Desc</li>';
        ?>
    </div>
</div>
