<?php
namespace SmartDPE\Admin;

defined('ABSPATH') || exit;

class PostMetaBox {

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'register_meta_box']);
        add_action('admin_init', [$this, 'handle_clear_cache']);
    }

    public function register_meta_box() {
        $post_types = get_post_types(['public' => true]);

        foreach ($post_types as $post_type) {
            add_meta_box(
                'smart_dpe_clear_cache',
                __('Smart DPE', 'smart-dpe'),
                [$this, 'render_meta_box'],
                $post_type,
                'side',
                'high'
            );
        }
    }

    public function render_meta_box($post) {
        $post_id = $post->ID;
        if (!current_user_can('edit_post', $post_id)) return;

        $nonce = wp_create_nonce('smart_dpe_clear_cache_' . $post_id);
        $clear_url = add_query_arg([
            'smart_dpe_action' => 'clear_cache',
            'post' => $post_id,
            'smart_dpe_nonce' => $nonce
        ]);

        echo '<p>' . esc_html__('Clear the Smart DPE cache to force the regeneration of labels for this content.', 'smart-dpe') . '</p>';
        echo '<p><a href="' . esc_url($clear_url) . '" class="button button-secondary">' . esc_html__('Clear Smart DPE Cache', 'smart-dpe') . '</a></p>';

        if (isset($_GET['smart_dpe_cache_cleared']) && intval($_GET['post']) === $post_id) {
            echo '<p style="color:green; margin-top:10px;">' . esc_html__('Smart DPE cache cleared for this content.', 'smart-dpe') . '</p>';
        }
    }

    public function handle_clear_cache() {
        if (!isset($_GET['smart_dpe_action']) || $_GET['smart_dpe_action'] !== 'clear_cache') {
            return;
        }

        $post_id = intval($_GET['post']);

        if (!isset($_GET['smart_dpe_nonce']) || !wp_verify_nonce($_GET['smart_dpe_nonce'], 'smart_dpe_clear_cache_' . $post_id)) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        global $wpdb;
        $like = '_transient_smart_dpe_' . $post_id . '_%';

        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
                $like
            )
        );

        // Redirige pour nettoyer l'URL et éviter de re-clear à chaque reload
        wp_safe_redirect(
            add_query_arg([
                'post' => $post_id,
                'action' => 'edit',
                'smart_dpe_cache_cleared' => 1
            ], admin_url('post.php'))
        );
        exit;

    }
}
