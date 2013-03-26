<?php

function array_get_pop(&$array, $key) {
    $value = @$array[$key];
    unset($array[$key]);
    return $value;
}

function save_forms_add_form(&$form_data) {
    global $wpdb;

    $form_id = (int) array_get_pop($form_data, 'form_id');
    if (!$form_id) {
        $form_name = array_get_pop($form_data, 'form_name');
        if (!$form_name) {
            return null;
        }

        $query = $wpdb->prepare('SELECT id FROM wp_save_forms WHERE name = %s LIMIT 1', $form_name);
        $form_id = (int) $wpdb->get_var($query) ?: null;
    }

    //if ($form_id) {
        $wpdb->insert('wp_save_formdata', array(
            'created_at' => time(),
            'form_id' => $form_id,
            'name' => array_get_pop($form_data, 'name'),
            'data' => json_encode($form_data),
        ));
    //}
}

