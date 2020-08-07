// unregister_blocks.js

/* see 
https://developer.wordpress.org/block-editor/developers/filters/block-filters/
*/


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

const CORE_BLACKLIST = [
    // "core/quote",
    // "core/audio",
    // "core/file",
    // "core/video",
]

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

const WIDGET_BLACKLIST = [
  "core/archives",
  "core/categories",
  "core/latest-comments",
  "core/latest-posts",
  "core/rss",
  "core/search",
  "core/tag-cloud",
]

/* EMBED */
/*
    core/embed
    core-embed/twitter
    core-embed/youtube
    core-embed/facebook
    core-embed/instagram
    core-embed/soundcloud
    core-embed/vimeo
    core-embed/issuu
    core-embed/slideshare

    core-embed/wordpress
    core-embed/spotify
    core-embed/flickr
    core-embed/animoto
    core-embed/cloudup
    core-embed/collegehumor
    core-embed/dailymotion
    core-embed/funnyordie
    core-embed/hulu
    core-embed/imgur
    core-embed/kickstarter
    core-embed/meetup-com
    core-embed/mixcloud
    core-embed/photobucket
    core-embed/polldaddy
    core-embed/reddit
    core-embed/reverbnation
    core-embed/screencast
    core-embed/scribd
    core-embed/smugmug
    core-embed/speaker
    core-embed/ted
    core-embed/tumblr
    core-embed/videopress
    core-embed/wordpress-tv
    */

const EMBED_BLACKLIST = [
    "core-embed/wordpress",
    "core-embed/spotify",
    "core-embed/flickr",
    "core-embed/animoto",
    "core-embed/cloudup",
    "core-embed/collegehumor",
    "core-embed/dailymotion",
    "core-embed/funnyordie",
    "core-embed/hulu",
    "core-embed/imgur",
    "core-embed/kickstarter",
    "core-embed/meetup-com",
    "core-embed/mixcloud",
    "core-embed/photobucket",
    "core-embed/polldaddy",
    "core-embed/reddit",
    "core-embed/reverbnation",
    "core-embed/screencast",
    "core-embed/scribd",
    "core-embed/smugmug",
    "core-embed/speaker",
    "core-embed/ted",
    "core-embed/tumblr",
    "core-embed/videopress",
    "core-embed/wordpress-tv",
]

// my-plugin.js
wp.domReady( function() {
    for(const black of EMBED_BLACKLIST) {
      wp.blocks.unregisterBlockType( black );
    }
    for(const black of WIDGET_BLACKLIST) {
      wp.blocks.unregisterBlockType( black );
    }
    
    // CORE_BLACKLIST
} );