<?php

require('wp-config.php');
require('wp-includes/load.php');

require_wp_db();
wp_set_wpdb_vars();

$redirect_to = (empty($_GET['redirect_to'])? $_SERVER['HTTP_REFERER']: $_GET['redirect_to']) ?: '/';

function array_get_pop(&$array, $key) {
    $value = @$array[$key];
    unset($array[$key]);
    return $value;
}

function get_form_id() {
    global $wpdb;

    $form_id = (int) array_get_pop($_POST, 'form_id');
    if (!$form_id) {
        $form_name = array_get_pop($_POST, 'form_name');
        if (!$form_name) {
            return null;
        }

        $query = $wpdb->prepare('SELECT id FROM wp_save_forms WHERE name = %s LIMIT 1', $form_name);
        return (int) $wpdb->get_var($query) ?: null;
    }
}

$form_id = get_form_id();
if ($form_id) {
    $wpdb->insert('wp_save_formdata', array(
        'created_at' => time(),
        'form_id' => $form_id,
        'name' => array_get_pop($_POST, 'name'),
        'data' => json_encode($_POST),
    ));
}

header('Status: 302');
header('Location: ' . $redirect_to);

