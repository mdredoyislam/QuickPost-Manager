<?php
    function dvsocial_icons_shortcode_func($arguments){

        // Shortcode attributes with defaults
        $attributes = shortcode_atts($arguments, 'dvsocials');
        // Query to fetch team members


        // Start output buffering
        ob_start();

        $rows = get_field('desvert_social_links', 'option');
        echo '<div class="desvert-social-icons-wrapper">';

        foreach($rows as $row){
            $iconclass = $row['social_icons_class'];
            $iconlink = $row['profile_links'];
            ?>
                <span class="desvert-grid-item">
                    <a href="<?php echo $iconlink; ?>" class="desvert-icon desvert-social-icon" target="_blank">
                        <i class="<?php echo $iconclass; ?>" aria-hidden="true"></i>
                    </a>
                </span>
            <?php
        }
        echo '</div>';

        // Return the output buffer content
        return ob_get_clean();
    }
    add_shortcode('dvsocial-icons','dvsocial_icons_shortcode_func');

    function services_icons_shortcode_func($post_id){

        // Start output buffering
        ob_start();
        //$services_icon = get_post_meta($post_id, 'services_icon', true);
        $dvservices_icons = get_field('services_icon');
        if ( 'dashicons' === $dvservices_icons['type'] ){
        ?>
            <div class='services-icon-wrap'>
                <span class="services-custom-icon <?php echo esc_attr( $dvservices_icons['type'] ) .' '. esc_attr( $dvservices_icons['value'] ); ?>"></span>
            </div>
        <?php
        }
        // Return the output buffer content
        return ob_get_clean();
    }
    add_shortcode('services-icons','services_icons_shortcode_func');