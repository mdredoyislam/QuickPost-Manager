<?php

    //Education Post Custom Columns
    function desvertcore_project_columns( $columns ){
        unset($columns['date']);
        $columns['title'] = __('Project Title', 'desvertcore');
        $columns['projectFeature'] = __('Project Feature', 'desvertcore');
        $columns['date'] = __('Date', 'desvertcore');

        return $columns;
    }
    add_filter('manage_project_posts_columns', 'desvertcore_project_columns');

    function desvertcore_project_column_data($column, $post_id){

        if('projectFeature' == $column){

            //echo get_post_meta($post_id, 'name_of_company', true);
            $thumbnail = get_the_post_thumbnail($post_id, array(200,80), array('class'=>'project-feature'));
            echo $thumbnail;

        }

    }
    add_action('manage_project_posts_custom_column', 'desvertcore_project_column_data', 10, 2);