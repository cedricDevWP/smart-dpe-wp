<?php
namespace SmartDPE\Front;

use SmartDPE\Services\ApiService;

defined('ABSPATH') || exit;

class Shortcode {

    private $api_service;

    public function __construct() {
        add_shortcode('smart_dpe', [$this, 'handle_shortcode']);
    }

    public function handle_shortcode($atts) {
        $this->api_service = new ApiService();

        $atts = shortcode_atts([
            'id'     => '',
            'dpe'    => '',
            'ges'    => '',
            'format' => 'jpg',
        ], $atts, 'smart_dpe');

        $id = intval($atts['id']);
        $dpe = intval($atts['dpe']);
        $ges = intval($atts['ges']);
        $format = in_array($atts['format'], ['jpg', 'png']) ? $atts['format'] : 'jpg';

        if (!isset($id) || $id <= 0) {
            if ($dpe <= 0 || $ges <= 0) {
                return '<p>' . esc_html__('Invalid DPE or GES values.', 'smart-dpe') . '</p>';
            }
        }

        // Unique cache key
        global $post;
        $post_id = isset($post->ID) ? $post->ID : 0;
        $hash = md5($id . '_' . $dpe . '_' . $ges . '_' . $format);
        $key  = 'smart_dpe_' . $post_id . '_' . $hash;

        $cached = get_transient($key);

        if ($cached) {
            $image_base64 = $cached;
        } else {
            $image_base64 = $this->api_service->generate_etiquette_base64($id, $dpe, $ges, $format);

            if (!is_wp_error($image_base64)) {
                set_transient($key, $image_base64, DAY_IN_SECONDS * 7); // 7 jours
            }
        }

        if (is_wp_error($image_base64)) {
            if( is_user_logged_in() ) {
                return '<p>' . esc_html__('Error: ', 'smart-dpe') . esc_html($image_base64->get_error_message()) . '</p>';
            } else {
                return;
            }
        }

        return sprintf(
            '<img src="data:image/%1$s;base64,%2$s" alt="%3$s" class="smart-dpe-label" loading="lazy">',
            esc_attr($format),
            esc_attr($image_base64),
            esc_attr__('Smart DPE label', 'smart-dpe')
        );    
    }
}
