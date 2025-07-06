<?php
namespace SmartDPE;

use SmartDPE\Admin\AdminPage;
use SmartDPE\Admin\PostMetaBox;
use SmartDPE\Cron;
use SmartDPE\Front\Shortcode;

defined('ABSPATH') || exit;

class SmartDPE {

    public function __construct() {
        add_action('plugins_loaded', [$this, 'load_textdomain']);
    }

    public function run() {
        new AdminPage();
        new Cron();
        new Shortcode();
        new PostMetaBox();
    }

    public function load_textdomain() {
        load_plugin_textdomain(
            'smart-dpe',
            false,
            dirname(plugin_basename(__FILE__), 2) . '/languages'
        );
    }
}
