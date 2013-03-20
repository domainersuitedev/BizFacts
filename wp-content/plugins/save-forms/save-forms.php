<?php
/**
 * @package Save Forms
 */
/*
Plugin Name: Save Forms
Plugin URI: http://paradisemodern.unfuddle.com/
Description: Custom forms storage
Version: 0.0.1
Author: Konstantin Stepanov
Author URI: http://kstep.me/
License: proprietary
*/

function array_flatten(array $array, $prefix = '')
{
    $result = array();

    foreach ($array as $key => $value) {
        if ($prefix) {
            $key = "{$prefix}[{$key}]";
        }

        if (is_object($value)) {
            $result += array_flatten(get_object_vars($value), $key);
        } elseif (is_array($value)) {
            $result += array_flatten($value, $key);
        } else {
            $result[$key] = $value;
        }
    }

    return $result;
}

function format_label($field_name)
{
    return ucwords(str_replace('_', ' ', $field_name));
}

function save_forms_install() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;

    $save_forms_table = $wpdb->prefix . 'save_forms';
    $sql = "CREATE TABLE {$save_forms_table} (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    )";
    dbDelta($sql);

    $save_formdata_table = $wpdb->prefix . 'save_formdata';
    $sql = "CREATE TABLE {$save_formdata_table} (
        id INT NOT NULL AUTO_INCREMENT,
        form_id INT NOT NULL,
        data TEXT NOT NULL,
        name VARCHAR(255) NOT NULL,
        created_at INT NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    )";
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'save_forms_install');

function save_forms_admin_menu() {
    $page = add_menu_page('Saved Forms', 'Saved Forms', 'manage_options', 'save-forms-saved-forms', 'save_forms_handle_saved_forms');
    add_submenu_page('save-forms-saved-forms', 'Available Forms', 'Available Forms',  'manage_options', 'save-forms-available-forms', 'save_forms_handle_available_forms');
}
add_action('admin_menu', 'save_forms_admin_menu');

define('SAVE_FORMS_ITEMS_PER_PAGE', 20);

function save_forms_handle_saved_forms() {
    global $wpdb;

    $page = (int) @$_GET['p'];
    if ($page < 1) $page = 1;

    $form_id = (int) @$_GET['form_id'];

    $action = @$_GET['action'];
    switch ($action) {
        case 'delete':
            $wpdb->delete('wp_save_formdata', array('id' => @$_GET['id']), '%d');
        break;

        case 'view':
        case 'edit':
            $method = @$_SERVER['REQUEST_METHOD'] ?: 'GET';
            $id = (int) @$_GET['id'];

            if (!$id) { break; }

            $form = $wpdb->get_row("SELECT * FROM wp_save_formdata WHERE id = {$id}");
            if (!$form) { break; }

            if ($method == 'POST' and $action == 'edit') {
                $data = json_encode($_POST);
                $wpdb->update('wp_save_formdata', array('data' => json_encode($_POST)), array('id' => $id), '%s', '%d');
                break;
            }

            $form_name = $wpdb->get_var($wpdb->prepare("SELECT name FROM wp_save_forms WHERE id = %d", array($form->form_id)));
            $form_file = __DIR__ . '/forms/' . $action . '-' . preg_replace('/[^0-9a-zA-Z_-]/', '-', $form_name) . '.php';

            $form_data = json_decode($form->data, true);

            if (file_exists($form_file)) {
                include($form_file);
            } else {
?>
            <h3><?= $form->name ?: 'Untitled Form' ?> <small>(<?= $form_name ?>)</small></h3>
            <?php if ($action == 'edit'): ?>
            <form method="POST">
                <input type="submit" value="Save" />
                <a href="?page=save-forms-saved-forms&p=<?= $page ?>&form_id=<?= $form_id ?>">Cancel</a>
                <dl>
                <?php $fields = array_flatten($form_data) ?>
                <?php foreach ($fields as $field => $value): ?>
                    <?php $label = format_label($field); ?>
                    <dt><?= $label ?></dt>
                    <dd><textarea name="<?= $field ?>"><?= $value ?></textarea></dd>
                <?php endforeach ?>
                </dl>
                <input type="submit" value="Save" />
                <a href="?page=save-forms-saved-forms&p=<?= $page ?>&form_id=<?= $form_id ?>">Cancel</a>
            </form>
            <?php else: ?>
                <a href="?page=save-forms-saved-forms&p=<?= $page ?>&form_id=<?= $form_id ?>">← List</a>
                <table>
                <?php $fields = array_flatten($form_data) ?>
                <?php foreach ($fields as $field => $value): ?>
                    <tr>
                    <?php $label = format_label($field); ?>
                    <th align="left"><?= $label ?></th>
                    <td><?= $value ?></td>
                    </tr>
                <?php endforeach ?>
                </table>
                <a href="?page=save-forms-saved-forms&p=<?= $page ?>&form_id=<?= $form_id ?>">← List</a>
            <?php endif ?>
<?php
            }
            exit();
        break;

        default:
    }

    $offset = ($page - 1) * SAVE_FORMS_ITEMS_PER_PAGE;

    $sql_filter = $form_id? "WHERE form_id = {$form_id}": "";

    $total_saved_forms = (int) $wpdb->get_var("SELECT COUNT(*) FROM wp_save_formdata $sql_filter");
    $saved_forms = $wpdb->get_results("SELECT * FROM wp_save_formdata $sql_filter ORDER BY id DESC LIMIT $page, " . SAVE_FORMS_ITEMS_PER_PAGE);
    $total_pages = ceil($total_saved_forms / SAVE_FORMS_ITEMS_PER_PAGE);

    $form_types = $wpdb->get_results("SELECT * FROM wp_save_forms ORDER BY name");
?>
    <form method="GET">
        <input type="hidden" value="save-forms-saved-forms" name="page" />
        <label for="save-forms-form-id">Select form:
            <select name="form_id" id="save-forms-form-id">
                <option value="0">-- All --</option>
                <?php foreach ($form_types as $item): ?>
                <option value="<?= $item->id ?>" <?= $item->id == $form_id? 'selected': '' ?>><?= $item->name ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="Go" />
        </label>
    </form>
    <table>
        <thead>
            <tr>
                <th>Entry Name</th>
                <th>Timestamp</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($saved_forms as $item): ?>
            <tr>
                <td><?= $item->name ?: 'Untitled' ?></td>
                <td><?= date('n/d/Y g:m a', $item->created_at) ?></td>
                <td>
                    <a href="?page=save-forms-saved-forms&action=view&id=<?= $item->id ?>&form_id=<?= $form_id ?>&p=<?= $page ?>">View</a> |
                    <a href="?page=save-forms-saved-forms&action=edit&id=<?= $item->id ?>&form_id=<?= $form_id ?>&p=<?= $page ?>">Edit</a> |
                    <a href="?page=save-forms-saved-forms&action=delete&id=<?= $item->id ?>&form_id=<?= $form_id ?>&p=<?= $page ?>" onclick="return confirm('Are you sure you want to delete this form data?');">Delete</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
<?php if ($total_pages > 1): ?>
    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
        <?php if ($p != $page): ?>
            <a href="?page=save-forms-saved-forms&form_id=<?= $form_id ?>&p=<?= $p ?>"><?= $p ?></a>
        <?php else: ?>
            <b><?= $p ?></b>
        <?php endif ?>
    <? endfor ?>
<?php endif ?>
<?php
    
}

function save_forms_handle_available_forms() {
    global $wpdb;
    $action = @$_GET['action'];

    switch ($action) {
        case 'delete':
            $id = (int) @$_GET['id'];
            $wpdb->delete('wp_save_forms', array('id' => $id), '%d');
        break;

        case 'add':
            $method = @$_SERVER['REQUEST_METHOD'] ?: 'GET';
            if ($method == 'POST') {
                $name = $_POST['name'];
                $wpdb->insert('wp_save_forms', array('name' => $name));
                break;
            }
?>
<form method="POST">
    <label>New Form Name: <input name="name" type="text" /></label>
    <input type="submit" value="Create" />
    <a href="?page=save-forms-available-forms">Cancel</a>
</form>
<?php
            exit();
        break;

        case 'edit':
            $method = @$_SERVER['REQUEST_METHOD'] ?: 'GET';
            $id = (int) @$_GET['id'];

            if (!$id) { break; }

            if ($method == 'POST') {
                $wpdb->update('wp_save_forms', array('name' => @$_POST['name']), array('id' => $id), '%s', '%d');
                break;
            }
?>
<form method="POST">
    <label>Form Name: <input name="name" type="text" value="<?= $wpdb->get_var("SELECT name FROM wp_save_forms WHERE id = {$id}") ?>" /></label>
    <input type="submit" value="Save" />
    <a href="?page=save-forms-available-forms">Cancel</a>
</form>
<?php
            exit();
        break;

        default:
    }

    $forms = $wpdb->get_results("SELECT * FROM wp_save_forms ORDER BY name");
?>
    <table>
        <thead>
            <tr>
                <th>Form Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($forms as $item): ?>
            <tr>
                <td><?= $item->name ?></td>
                <td><a href="?page=save-forms-saved-forms&form_id=<?= $item->id ?>">Data</a> | <a href="?page=save-forms-available-forms&action=edit&id=<?= $item->id ?>">Edit</a> | <a href="?page=save-forms-available-forms&action=delete&id=<?= $item->id ?>" onclick="return confirm('Are you sure you want to delete this form?');">Delete</a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <a href="?page=save-forms-available-forms&action=add">Add new</a>
<?php
}
