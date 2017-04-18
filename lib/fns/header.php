<?php

namespace Salient\fns\header;

function social_icons( $location = '' ){
    global $options;

    $social_networks = array(
        'twitter' => 'fa fa-twitter',
        'facebook' => 'fa fa-facebook',
        'vimeo' => 'fa fa-vimeo',
        'pinterest' => 'fa fa-pinterest',
        'linkedin' => 'fa fa-linkedin',
        'youtube' => 'fa fa-youtube-play',
        'tumblr' => 'fa fa-tumblr',
        'dribbble' => 'fa fa-dribbble',
        'rss' => 'fa fa-rss',
        'github' => 'fa fa-github-alt',
        'google-plus' => 'fa fa-google-plus',
        'instagram' => 'fa fa-instagram',
        'stackexchange' => 'fa fa-stackexchange',
        'soundcloud' => 'fa fa-soundcloud',
        'flickr' => 'fa fa-flickr',
        'spotify' => 'icon-salient-spotify',
        'vk' => 'fa fa-vk',
        'vine' => 'fa fa-vine',
        'behance' => 'fa fa-behance'
    );
    $social_output_html = '';

    $social_link_before = '<li class="social-icon">';
    $social_link_after = '</li>';

    if($location == 'secondary-nav')
        $social_output_html .= '<ul id="social">';

        foreach($social_networks as $network_name => $icon_class) {

            if($network_name == 'rss') {
                if(!empty($options['use-'.$network_name.'-icon-header']) && $options['use-'.$network_name.'-icon-header'] == 1) {
                    $nectar_rss_url_link = (!empty($options['rss-url'])) ? $options['rss-url'] : get_bloginfo('rss_url');
                    $social_output_html .= $social_link_before.'<a target="_blank" href="'.$nectar_rss_url_link.'"><i class="'.$icon_class.'"></i> </a>'.$social_link_after;
                }
            }
            else {
                if(!empty($options['use-'.$network_name.'-icon-header']) && $options['use-'.$network_name.'-icon-header'] == 1)
                    $social_output_html .= $social_link_before.'<a target="_blank" href="'.$options[$network_name."-url"].'"><i class="'.$icon_class.'"></i> </a>'.$social_link_after;
            }
        }

    if($location == 'secondary-nav')
        $social_output_html .= '</ul>';

    echo $social_output_html;
}