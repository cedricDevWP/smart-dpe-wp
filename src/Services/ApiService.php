<?php
namespace SmartDPE\Services;

use SmartDPE\Option;

defined('ABSPATH') || exit;

class ApiService {

    private $option;

    public function __construct() {
        $this->option = new Option();
    }

    public function get_api_url() {
        return (defined('SMART_DPE_API_URL') ? trailingslashit(SMART_DPE_API_URL) : 'https://api.smart-dpe.immo/') . 'wp-json/';
    }

    public function request_token($email, $password) {
        $url = $this->get_api_url() . 'jwt-auth/v1/token';

        $response = wp_remote_post($url, [
            'timeout' => 15,
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'username' => $email,
                'password' => $password
            ])
        ]);

        if (is_wp_error($response)) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($code !== 200 || empty($body['data']['token'])) {
            $message = isset($body['message']) ? $body['message'] : __('Unknown API error.', 'smart-dpe');
            return new \WP_Error('api_error', $message);
        }

        return $body['data']['token'];
    }

    public function validate_token($token) {
        $url = $this->get_api_url() . 'wp-json/jwt-auth/v1/token/validate';

        $response = wp_remote_post($url, [
            'timeout' => 15,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/json',
            ],
        ]);

        if (is_wp_error($response)) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($code === 200 && !empty($body['success'])) {
            return true;
        }

        return false;
    }

    public function generate_etiquette_base64($id, $dpe, $ges, $format = 'jpg') {
        $token = $this->option->decrypt($this->option->get('token'));

        $args = [
            'timeout' => 15
        ];

        if ($token) {
            $args['headers']['Authorization'] = 'Bearer ' . $token;
        }

        if ($id > 0) {
            $url = $this->get_api_url() . 'smart-dpe/v1/etiquettes/' . $id . '/generer';
            $url = add_query_arg([
                'image_format' => $format,
            ], $url);
        } else {
            $url = $this->get_api_url() . 'smart-dpe/v1/etiquettes/generer';
            $url = add_query_arg([
                'dpe' => $dpe,
                'ges' => $ges,
                'image_format' => $format,
            ], $url);
        }

        $response = wp_remote_get($url, $args);

        if (is_wp_error($response)) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($code !== 201) {
            $message = isset($body['message']) ? $body['message'] : __('Error while generating the label.', 'smart-dpe');
            return new \WP_Error('api_error', $message);
        }

        return $body['data'][0];
    }
}
