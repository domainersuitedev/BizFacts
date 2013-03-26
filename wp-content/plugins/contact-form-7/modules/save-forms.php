<?php

add_action('wpcf7_before_send_mail', 'wpcf7_save_forms_handler');

require_once(dirname(__FILE__) . '/../../save-forms/functions.php');

function wpcf7_save_forms_handler(&$form_data)
{
    global $wpdb;

    $post_data = array(
        'form_name' => $form_data->title,
    );

    foreach ($form_data->posted_data as $key => $value) {
        if (substr($key, 0, 1) != "_") {
            $post_data[$key] = $value;
        }
    }

    save_forms_add_form($post_data);

    //$form_data->skip_mail = true;
}

