<?php

require('wp-config.php');
require('wp-includes/load.php');
require('wp-content/plugins/save-forms/functions.php');

require_wp_db();
wp_set_wpdb_vars();

save_forms_add_form($_POST);

$redirect_to = (empty($_GET['redirect_to'])? $_SERVER['HTTP_REFERER']: $_GET['redirect_to']) ?: '/';

header('Status: 302');
header('Location: ' . $redirect_to);

