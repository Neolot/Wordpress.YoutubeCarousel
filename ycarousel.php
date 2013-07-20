<?php
/*
Plugin Name: Youtube Carousel
Description: This is Wordpress plugin adds support for the shortcode, which displays the carousel of Youtube videos
Version: 1.0.3
Author: Yuriy Pokhylko aka Neolot
Author URI: http://neolot.com
*/

wp_enqueue_style(
    'ycarousel',
    plugins_url('/styles.css', __FILE__),
    array(),
    true,
    'all'
);
wp_enqueue_style(
    'fancybox',
    plugins_url('/fancybox/jquery.fancybox.css', __FILE__),
    array(),
    true,
    'all'
);

function yc_setScripts() {
    wp_enqueue_script(
        'fancybox',
        plugins_url('/fancybox/jquery.fancybox.pack.js', __FILE__),
        array('jquery'),
        true,
        true
    );
    wp_enqueue_script(
        'jcarousel',
        plugins_url('/jcarousel/jquery.jcarousel.min.js', __FILE__),
        array('jquery'),
        true,
        true
    );
    wp_enqueue_script(
        'ycarousel',
        plugins_url('/ycarousel.js', __FILE__),
        array('jquery'),
        true,
        true
    );
}
add_action('wp_enqueue_scripts', 'yc_setScripts');

function yc_ycarousel($atts, $content = null){
    extract(shortcode_atts(array(), $atts));
    if ( $content ) {
        $videos = explode(',', $content);
        $out = '<div class="ycarousel"><div class="ycarousel-container"><ul>';
        foreach ( $videos as $video ) {
            $video = trim($video);
            $thumb = 'http://img.youtube.com/vi/'.$video.'/0.jpg';

            $video_info = file_get_contents('http://youtube.com/get_video_info?video_id='.$video);
            parse_str($video_info, $ytarr);
            $title = $ytarr['title'];

            $url = 'http://www.youtube.com/embed/'.$video.'?autoplay=1';
            $out .= sprintf('<li><a class="various fancybox.iframe" href="%s"><img src="%s" width="180" height="135" alt=""/><span class="play"></span><span class="title">%s</span></a></li>', $url, $thumb, $title);
        }
        $out .= '</ul></div><a class="ycarousel-prev" href="javascript:void(0);"></a><a class="ycarousel-next" href="javascript:void(0);"></a></div>';
        return $out;
    }
}
add_shortcode('ycarousel', 'yc_ycarousel');
?>
