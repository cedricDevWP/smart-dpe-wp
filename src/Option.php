<?php
namespace SmartDPE;

defined('ABSPATH') || exit;

class Option {

    const OPTION_KEY = 'smart_dpe_settings';

    public function get_all() {
        return get_option(self::OPTION_KEY, []);
    }

    public function get($key, $default = '') {
        $options = $this->get_all();
        return isset($options[$key]) ? $options[$key] : $default;
    }

    public function update($key, $value) {
        $options = $this->get_all();
        $options[$key] = $value;
        update_option(self::OPTION_KEY, $options);
    }

    public function update_all(array $data) {
        $options = $this->get_all();
        foreach ($data as $key => $value) {
            $options[$key] = $value;
        }
        update_option(self::OPTION_KEY, $options);
    }

    public function delete($key) {
        $options = $this->get_all();
        if (isset($options[$key])) {
            unset($options[$key]);
            update_option(self::OPTION_KEY, $options);
        }
    }

    public function encrypt($data) {
        $key = SECURE_AUTH_KEY;
        $iv = substr(hash('sha256', SECURE_AUTH_SALT), 0, 16);
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv));
    }

    public function decrypt($data) {
        $key = SECURE_AUTH_KEY;
        $iv = substr(hash('sha256', SECURE_AUTH_SALT), 0, 16);
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $key, 0, $iv);
    }
}
