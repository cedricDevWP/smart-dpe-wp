<?php
/**
 * Plugin Name: Smart DPE
 * Description: Extension WordPress Smart DPE
 * Author: Cédric Chevillard
 * Author URI: https://smart-dpe.immo/
 * Text Domain: smart-dpe
 * Domain Path: /languages
 * Version: 1.0.0
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || exit;

// Autoloader Composer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    wp_die('Autoloader not found. Run composer install.');
}

use SmartDPE\SmartDPE;

$smart_dpe = new SmartDPE();
$smart_dpe->run();
