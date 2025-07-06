<?php
namespace SmartDPE;

use SmartDPE\Option;
use SmartDPE\Services\ApiService;

defined('ABSPATH') || exit;

class Cron {

    const HOOK = 'smart_dpe_check_token';

    private $option;
    private $api_service;

    public function __construct() {
        $this->option = new Option();
        $this->api_service = new ApiService();

        add_action('init', [$this, 'schedule_cron']);
        add_action(self::HOOK, [$this, 'check_token']);
    }

    /**
     * Schedule the cron to run daily at 2 AM.
     */
    public function schedule_cron() {
        if (!wp_next_scheduled(self::HOOK)) {
            wp_schedule_event(strtotime('02:00:00'), 'daily', self::HOOK);
        }
    }

    /**
     * Check the token and regenerate it if needed.
     */
    public function check_token() {
        $token = $this->option->get('token');

        if (!$token) {
            return;
        }

        $token = $this->option->decrypt($token);

        $is_valid = $this->api_service->validate_token($token);

        if ($is_valid === true) {
            return;
        }

        $email = $this->option->decrypt($this->option->get('email'));
        $password = $this->option->decrypt($this->option->get('password'));

        if (!$email || !$password) {
            return;
        }

        $new_token = $this->api_service->request_token($email, $password);

        if (is_wp_error($new_token)) {
            return;
        }

        $this->option->update('token', $this->option->encrypt($new_token));
    }
}
