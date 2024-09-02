<?php

    //Education Post Custom Columns
    function desvertcore_service_columns( $columns ){
        unset($columns['date']);

        $columns['title'] = __('Services Title', 'desvertcore');
        $columns['servicesIcons'] = __('Services Icons', 'desvertcore');
        $columns['totalProject'] = __('Total Projects', 'desvertcore');
        $columns['serviceFeature'] = __('Services Feature', 'desvertcore');
        $columns['servicesText'] = __('Services Description', 'desvertcore');
        $columns['date'] = __('Date', 'desvertcore');

        return $columns;
    }
    add_filter('manage_service_posts_columns', 'desvertcore_service_columns');

    function desvertcore_service_column_data($column, $post_id){

        if('servicesIcons' == $column){
            //echo get_post_meta($post_id, 'select_icon', true);
            $services_icon = get_field('services_icon');
            $services_icon_output = <<<EOD
                <div class='slide'>
                    <span class="dashicons {$services_icon}"></span>
                </div>
            EOD;
            echo $services_icon_output;

        }elseif('totalProject' == $column){
            $total_projects = get_field('total_projects');
            $total_project_output = <<<EOD
                <div class='slide'>
                    <p><strong>Total : {$total_projects}</strong> Project</p>
                </div>
            EOD;
            echo $total_project_output;

        }elseif('servicesText' == $column){
            echo get_the_content();
        }elseif('serviceFeature' == $column){
            $thumbnail = get_the_post_thumbnail($post_id, array(200,80), array('class'=>'service-feature'));
            echo $thumbnail;
        }

    }
    add_action('manage_service_posts_custom_column', 'desvertcore_service_column_data', 10, 2);