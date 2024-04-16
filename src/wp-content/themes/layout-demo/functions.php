<?php
error_reporting(E_ERROR | E_PARSE);
/*
 * Define Variables
 */
if (!defined('THEME_DIR'))
    define('THEME_DIR', get_template_directory());
if (!defined('THEME_URL'))
    define('THEME_URL', get_template_directory_uri());


/*
 * Include framework files
 */
foreach (glob(THEME_DIR . "/includes/*.php") as $file_name) {
    require_once($file_name);
}

//Add ACF options page
if (function_exists('acf_add_options_page')) {
    $parent = acf_add_options_page(__('Site Settings', 'lucius'));
}
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


function custom_login_check()
{
    // Receive data from AJAX request
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $url_file = '';
    if (isset($_POST['pageID'])) {
        $url_file = get_field('file_download', $_POST['pageID']);
    } 
    // Authenticate the user
    $user = wp_authenticate($username, $password);

    if (is_wp_error($user)) {
        // Return error message if authentication fails
        wp_send_json_error(array('message' => 'Đăng nhập thất bại. vui lòng kiểm tra lại tài khoản và mật khẩu.'));
    } else {
        // Successful login
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login);
        $response = array('message' => 'Login successful', 'url' => $url_file);
        wp_send_json_success($response);
    }
}

add_action('wp_ajax_custom_login_check', 'custom_login_check');
add_action('wp_ajax_nopriv_custom_login_check', 'custom_login_check');

function create_author_user($email, $password)
{
    $existing_user = get_user_by('email', $email);

    if (!$existing_user) {
        $new_user_data = array(
            'user_login' => $email,
            'user_pass' => $password,
            'user_email' => $email,
            'role' => 'author',
        );

        $user_id = wp_insert_user($new_user_data);

        if (is_wp_error($user_id)) {
            return false;
        } else {
            return $user_id;
        }
    } else {
        return false;
    }
}
function custom_register_check()
{
    $email = sanitize_email($_POST['username']);
    $password = sanitize_text_field($_POST['password']);
    if (!empty($email) && !empty($password)) {
        $user_id = create_author_user($email, $password);

        if ($user_id) {
            $user = get_user_by('id', $user_id);
            wp_set_current_user($user_id, $user->user_login);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $user->user_login);

            $response = array('success' => true, 'message' => 'User created and logged in.');
        } else {
            $response = array('success' => false, 'message' => 'Error creating user.');
        }
    } else {
        $response = array('success' => false, 'message' => 'Invalid data.');
    }
    wp_send_json_success($response);

    wp_die();
}

add_action('wp_ajax_custom_register', 'custom_register_check');
add_action('wp_ajax_nopriv_custom_register', 'custom_register_check');
