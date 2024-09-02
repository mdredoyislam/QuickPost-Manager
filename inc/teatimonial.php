<?php

    //Education Post Custom Columns
    function desvertcore_teatimonial_columns( $columns ){
        unset($columns['date']);
        $columns['title'] = __('Client Name', 'desvertcore');
        $columns['designation'] = __('Designation', 'desvertcore');
        $columns['profileImage'] = __('Profile Image', 'desvertcore');
        $columns['clientReview'] = __('Client Review', 'desvertcore');
        $columns['date'] = __('Date', 'desvertcore');

        return $columns;
    }
    add_filter('manage_teatimonial_posts_columns', 'desvertcore_teatimonial_columns');

    function desvertcore_teatimonial_column_data($column, $post_id){

        if('profileImage' == $column){

            $thumbnail = get_the_post_thumbnail($post_id, array(200,80), array('class'=>'profile-image'));
            echo $thumbnail;

        }elseif('designation' == $column){

            $designation = get_field('client_designation');
            echo $designation;
            
        }elseif('clientReview' == $column){

            echo get_the_content();
            
        }

    }
    add_action('manage_teatimonial_posts_custom_column', 'desvertcore_teatimonial_column_data', 10, 2);