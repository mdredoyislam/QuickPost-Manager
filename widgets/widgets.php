<?php
function desvertcore_dashboard_widget() {

	if ( current_user_can( 'edit_dashboard' ) ) {

		wp_add_dashboard_widget( 'desvertcoredashbordwidget',
			__( 'DesVert Widgets', 'dashboardwidget' ),
			'desvertcore_dashboardwidget_output',
			'desvertcore_dashboardwidget_configure'
		);

	}else {

		wp_add_dashboard_widget( 'desvertcoredashbordwidget',
			__( 'desvertcore Widgets', 'dashboardwidget' ),
			'desvertcore_dashboardwidget_output'
		);
	}

}
add_action( 'wp_dashboard_setup', 'desvertcore_dashboard_widget' );

function desvertcore_dashboardwidget_output(){

    $icons = DVCORE_ASSETS_ADMIN_IMG_DIR . 'favicon.png';

    $count_project = wp_count_posts( 'project' )->publish;
    $count_service = wp_count_posts( 'service' )->publish;
    $count_teatimonial = wp_count_posts( 'teatimonial' )->publish;
    

    $post_edit = admin_url(sprintf('edit.php?%s', http_build_query($_GET)));
    $all_project = $post_edit . "post_type=project";
    $all_service = $post_edit . "post_type=service";
    $all_teatimonial = $post_edit . "post_type=teatimonial";
    $count_output = <<<EOD
        <div class="dvwidget-main">
            <ul class="dv-post-cointer-list">
                <li class="project-count"><a href="{$all_project}"><img width="15" src="{$icons}" alt="widgets-icon" /> {$count_project} Projects</a></li>
                <li class="services-count"><a href="{$all_service}"><img width="15" src="{$icons}" alt="widgets-icon" /> {$count_service} Services</a></li>
                <li class="testimonial-count"><a href="{$all_teatimonial}"><img width="15" src="{$icons}" alt="widgets-icon" /> {$count_teatimonial} Reviews</a></li>
            </ul>
            <h2 class="hndle ui-sortable-handle">Develop By : <a href='www.redoyit.com'>Md. Redoy Islam</a></h2>	
        </div>
    EOD;
    echo $count_output;

}