<?php
/* make sure to have the same name / block id as in js */
register_block_type( 'larslo/hero', array(
    'render_callback' => 'hero_server_side_render_save',
) );


function hero_server_side_render_save( $attributes, $content ) {
    // $recent_posts = wp_get_recent_posts( array(
    //     'numberposts' => 1,
    //     'post_status' => 'publish',
    // ) );
    // if ( count( $recent_posts ) === 0 ) {
    //     return 'No posts';
    // }

    $howto = "<h2>HELLO</h2>";
    $howto .= "<p>As long as a block is in active development, with this way of server-side rendering (frontend)
    we prevent the validation errors in editor. 
    Postpone the 'save' thing as long as edit has finished.
    save should <b>return null</b> until then.
    append this file in main plugin file and make sure
    that
    <b>Block ID/Name is the same in JS and PHP</b>
    

    </p>";
    return $howto;
}

