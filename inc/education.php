<?php

    //Education Post Custom Columns
    function desvertcore_education_columns( $columns ){
        $columns['title'] = __('Name of Degree', 'desvertcore');
        $columns['instituteName'] = __('Institute Name', 'desvertcore');
        $columns['startDate'] = __('Start Date', 'desvertcore');
        $columns['endDate'] = __('End Date', 'desvertcore');
        $columns['duretion'] = __('Duration', 'desvertcore');

        return $columns;
    }
    add_filter('manage_education_posts_columns', 'desvertcore_education_columns');

    function desvertcore_education_column_data($column, $post_id){

        if('instituteName' == $column){
            echo get_post_meta($post_id, 'institute_name', true);
        }elseif('startDate' == $column){

            //echo get_post_meta($post_id, 'start_date', true);
            $start_date = get_field('start_date');
            $start_date_return = date("F j, Y", strtotime($start_date));
            echo $start_date_return;

        }elseif('endDate' == $column){

            //echo get_post_meta($post_id, 'end_date', true);
            $is_present = get_field('present');
            if(1 == $is_present){
                $end_date = date('F j, Y');
            }else{
                $end_date = get_field('end_date');
            }
            $end_date_return = date("F j, Y", strtotime($end_date));
            echo $end_date_return;

        }elseif('duretion' == $column){

            $sdate = get_field('start_date');
            $is_present = get_field('present');
            if(1 == $is_present){
                $edate = date('F j, Y');
            }else{
                $edate = get_field('end_date');
            }
            $date_diff = abs(strtotime($edate) - strtotime($sdate));
            $years = floor($date_diff / (365*60*60*24));
            $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            printf("%d years, %d months, %d days", $years, $months, $days);

        }

    }
    add_action('manage_education_posts_custom_column', 'desvertcore_education_column_data', 10, 2);