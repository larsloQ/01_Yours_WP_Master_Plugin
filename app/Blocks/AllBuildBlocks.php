<?php
namespace Yours\Plugin\Blocks;

use Yours\Plugin\Plugin;

/**
 * This handles all generall settings / settings for all blocks
 * handle of core-blocks etc
 *
 * blocks are build inside of blockbuilder,
 *
 * all frontend specifics things for blocks are done in theme,
 *
 *
 */

class AllBuildBlocks extends Plugin
{

    public function __construct()
    {

        /* register_block_meta for accessing via gutenberg editor*/

        /**
         * Enqueue block script and backend stylesheet.
         */
        add_action('enqueue_block_editor_assets', function () {

            /* unregister (blacklist) certain blocks
            https://developer.wordpress.org/block-editor/developers/filters/block-filters/
             */
            wp_enqueue_script(
                'unregister_blocks',
                plugins_url('js/unregister_blocks.js', __FILE__),
                array('wp-blocks', 'wp-element', 'wp-edit-post')
            );
            //   wp_enqueue_script(
            //     'addFieldsToImageBlock',
            //     plugins_url( 'js/addFieldsToImageBlock.js', __FILE__ ),
            //     array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
            // );

            wp_enqueue_script(
                'yours_blocks_filter',
                plugins_url('js/block-filters.js', __FILE__),
                array('wp-blocks', 'wp-dom-ready', 'wp-edit-post')
            );

            /* builded blocks main file 
             this file is produced by blockbuilder             */
            wp_enqueue_script('liasonblocks',
                plugins_url('js/editor.blocks.js', __FILE__),
                ['wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post']
            );
            /* this comes from blockbuilder*/
            wp_enqueue_style('editor1',
                plugins_url('css/editor.blocks.css', __FILE__)
            );
           

        });

        /* set editor colors */
        add_action('after_setup_theme', array($this, "block_editor_general_settings"), PHP_INT_MAX);
        add_filter('block_categories', array($this, 'add_block_categories'));

        /* dequeue frontend block-library
        wp-includes/css/dist/block-library/style.min.css?ver=5.0.3
        see
        https://github.com/WordPress/gutenberg/issues/7776
         */
        // add_action( 'wp_enqueue_scripts', 'custom_theme_assets', 100 );
        // function custom_theme_assets() {
        //     wp_dequeue_style( 'wp-block-library' );
        // }

        /* wrap a div around the standard core/paragraph block tag*/
        add_filter('render_block', function ($block_content, $block) {

            if ('core/image' === $block['blockName']) {
                if (strlen($block['attrs']['hover_text']) > 3) {
                    $link     = filter_var($block['attrs']['hover_link'], FILTER_VALIDATE_URL) ? $block['attrs']['hover_link'] : 0;
                    $linkwrap = $link ? "<a href='" . $block['attrs']['hover_link'] . "'>" : "";

                    /*
                     * ADDING HOVER ON IMAGES
                     */
                    $bc = '<div class="hover_image"><div class="inner"><div>' . $linkwrap;
                    $bc .= '<span>' . $block['attrs']['hover_text'] . '</span>';
                    $bc .= strlen($linkwrap) > 0 ? '</a>' : "";
                    $bc .= '</div>';
                    $bc .= '</div>';
                    $bc .= $block_content;
                    $bc .= '</div>';
                    $block_content = $bc;
                }
            }

            // Remove the block/timed-block from the rendered content.
            if ('core/paragraph' === $block['blockName']) {
                $block_content = '<div class="paragraph">' . $block_content . '</div>';
            }

/*
 * MAKING YOUTUBE CONSENT SAVE
 * MAKING YOUTUBE CONSENT SAVE
 * MAKING YOUTUBE CONSENT SAVE
 * MAKING YOUTUBE CONSENT SAVE
 */
            if ('core-embed/youtube' === $block['blockName']) {
                /* replacing consent */
                $inner = $block['innerHTML'];
                $inner = str_ireplace("src=", "need-consent=", $inner);
                $wide  = $block['attrs']['align'] == "wide" || $block['attrs']['align'] == "full" ? "alignwide" : "";

                // $wide = stripos( "alignfull", $inner ) ? "alignwide" : "";
                $block_content = "<div class='vid-embed-wrap $wide'>" . $inner . "</div>";
            }

            return $block_content;
        }, 10, 2);

    }

    /**
     * Add a block category for "Get With Gutenberg" if it doesn't exist already.
     *
     * @param array $categories Array of block categories.
     *
     * @return array
     */
    public function add_block_categories($categories)
    {
        $category_slugs = wp_list_pluck($categories, 'slug');
        return in_array('liaison', $category_slugs, true) ? $categories : array_merge(
            $categories,
            array(
                array(
                    'slug'  => 'liaison',
                    'title' => __('Liaison', 'liaison'),
                    'icon'  => "smiley",
                ),
            )
        );
    }

    /* 
    overview here
    https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
     */

    public function block_editor_general_settings()
    {

        /*Custom Font Sizes*/
        add_theme_support('disable-custom-font-sizes');
        /* not working https://github.com/WordPress/gutenberg/pull/13782*/
        add_theme_support('editor-font-sizes', array(array(),
            // array(
            //     'name' => __( 'Small', 'themeLangDomain' ),
            //     'size' => 12,
            //     'slug' => 'small'
            // ),
            // array(
            //     'name' => __( 'Normal', 'themeLangDomain' ),
            //     'size' => 16,
            //     'slug' => 'normal'
            // ),
            // array(
            //     'name' => __( 'Large', 'themeLangDomain' ),
            //     'size' => 36,
            //     'slug' => 'large'
            // ),
            // array(
            //     'name' => __( 'Huge', 'themeLangDomain' ),
            //     'size' => 50,
            //     'slug' => 'huge'
            // )
        ));

        /* this is very confusing , and not working, file is loaded but style are not applied
        https://github.com/WordPress/gutenberg/issues/9873
         */
        add_theme_support('editor-styles');
        // add_editor_style(plugins_url( 'yours-editor-styles.css', __FILE__ ) );

        add_theme_support('align-wide');
        /*
         *disable-custom-colors needs to be set (allow each block to set own colors)
         *then
         *editor-color-palette is applied to all blocks
         */
        add_theme_support('disable-custom-colors');
        add_theme_support('editor-color-palette', array(
            array(
                'name'  => __('Dark Green', 'yours'),
                'slug'  => 'dgreen',
                'color' => '#278F18',
            ),
            array(
                'name'  => __('Green', 'yours'),
                'slug'  => 'green',
                'color' => '#62BD57',
            ),
            array(
                'name'  => __('Turkis', 'yours'),
                'slug'  => 'turkis',
                'color' => '#006064',
            ),
            array(
                'name'  => __('Black', 'yours'),
                'slug'  => 'black',
                'color' => '#181716',
            ),
            array(
                'name'  => __('Dark Gray', 'yours'),
                'slug'  => 'dgray',
                'color' => '#464646',
            ),
            array(
                'name'  => __('Gray', 'yours'),
                'slug'  => 'gray',
                'color' => '#9E9E9E',
            ),
        )
        );

    }

/*https://rudrastyh.com/gutenberg/remove-default-blocks.html*/
/*  CORE
core/paragraph
core/image
core/heading
(Deprecated) core/subhead — Subheading
core/gallery
core/list
core/quote
core/audio
core/cover (previously core/cover-image)
core/file
core/video
 */

/* FORMATING*/
/*
core/table
core/verse
core/code
core/freeform — Classic
core/html — Custom HTML
core/preformatted
core/pullquote
 */
/* LAYOUT */
/*
core/button
core/text-columns — Columns
core/media-text — Media and Text
core/more
core/nextpage — Page break
core/separator
core/spacer
 */

/* WIDGETS */
/*
core/shortcode
core/archives
core/categories
core/latest-comments
core/latest-posts
core/calendar
core/rss
core/search
core/tag-cloud
 */

/* EMBED */
/*
core/embed
core-embed/twitter
core-embed/youtube
core-embed/facebook
core-embed/instagram
core-embed/wordpress
core-embed/soundcloud
core-embed/spotify
core-embed/flickr
core-embed/vimeo
core-embed/animoto
core-embed/cloudup
core-embed/collegehumor
core-embed/dailymotion
core-embed/funnyordie
core-embed/hulu
core-embed/imgur
core-embed/issuu
core-embed/kickstarter
core-embed/meetup-com
core-embed/mixcloud
core-embed/photobucket
core-embed/polldaddy
core-embed/reddit
core-embed/reverbnation
core-embed/screencast
core-embed/scribd
core-embed/slideshare
core-embed/smugmug
core-embed/speaker
core-embed/ted
core-embed/tumblr
core-embed/videopress
core-embed/wordpress-tv
 */

    public function allowed_block_types($allowed_blocks, $posttype)
    {

        return array(
            'core/image',
            'core/paragraph',
            'core/heading',
            'core/list',
        );

    }

}
