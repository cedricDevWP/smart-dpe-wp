<?php
namespace SmartDPE;

use SmartDPE\Admin\AdminPage;
use SmartDPE\Admin\PostMetaBox;
use SmartDPE\Cron;
use SmartDPE\Front\Shortcode;

defined('ABSPATH') || exit;

class SmartDPE {

    public function __construct() {

    }

    public function run() {
        new AdminPage();
        new Cron();
        new Shortcode();
        new PostMetaBox();
    }
}
