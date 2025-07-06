<?php
namespace SmartDPE\Admin;

use SmartDPE\Option;
use SmartDPE\Services\ApiService;

defined('ABSPATH') || exit;

class AdminPage {

    private $option;
    private $api_service;

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
        add_action('admin_init', [$this, 'handle_form']);
    }

    public function register_menu() {
        add_options_page(
            __('Smart DPE Settings', 'smart-dpe'),
            'Smart DPE',
            'manage_options',
            'smart-dpe',
            [$this, 'render_page']
        );
    }

    public function render_page() {
        $this->option = new Option();

        $has_creds = $this->option->get('email') && $this->option->get('password');
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Smart DPE Settings', 'smart-dpe'); ?></h1>
            <form method="post">
                <?php wp_nonce_field('smart_dpe_save', 'smart_dpe_nonce'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php esc_html_e('Email', 'smart-dpe'); ?> <sup>*</sup></th>
                        <td>
                            <input type="<?php echo $has_creds ? 'password' : 'email'; ?>"
                                   name="smart_dpe_email"
                                   value="<?php echo $has_creds ? '********' : ''; ?>"
                                   class="regular-text"
                                   required <?php if ($has_creds) echo "disabled"; ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Password', 'smart-dpe'); ?> <sup>*</sup></th>
                        <td>
                            <input type="password"
                                   name="smart_dpe_password"
                                   value="<?php echo $has_creds ? '********' : ''; ?>"
                                   class="regular-text"
                                   required <?php if ($has_creds) echo "disabled"; ?>>
                        </td>
                    </tr>
                </table>
                <?php
                if ($has_creds) {
                    submit_button(__('Disconnect', 'smart-dpe'), 'delete', 'smart_dpe_disconnect');
                } else {
                    submit_button(__('Save & Connect', 'smart-dpe'));
                }
                ?>
            </form>
        </div>
        <?php
    }

    public function handle_form() {
        if (!isset($_POST['smart_dpe_nonce']) || !wp_verify_nonce($_POST['smart_dpe_nonce'], 'smart_dpe_save')) {
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        $this->option = new Option();

        if (isset($_POST['smart_dpe_disconnect'])) {
            $this->option->delete('email');
            $this->option->delete('password');
            $this->option->delete('token');

            add_settings_error('smart_dpe', 'disconnected', __('You have been disconnected.', 'smart-dpe'), 'updated');
            return;
        }

        $email = sanitize_email($_POST['smart_dpe_email']);
        $password = sanitize_text_field($_POST['smart_dpe_password']);

        // Do not save if user left placeholder
        if ($email === '***') {
            $email = $this->option->decrypt($this->option->get('email'));
        }

        if ($password === '***') {
            $password = $this->option->decrypt($this->option->get('password'));
        }

        $this->api_service = new ApiService();
        $token = $this->api_service->request_token($email, $password);

        if (is_wp_error($token)) {
            add_settings_error('smart_dpe', 'token_error', $token->get_error_message(), 'error');
            return;
        }

        $this->option->update_all([
            'email'    => $this->option->encrypt($email),
            'password' => $this->option->encrypt($password),
            'token'    => $this->option->encrypt($token),
        ]);

        add_settings_error('smart_dpe', 'settings_updated', __('Settings saved.', 'smart-dpe'), 'updated');
    }
}
