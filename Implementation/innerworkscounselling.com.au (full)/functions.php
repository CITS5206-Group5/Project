<?php

function iwc_theme_setup() {
    add_theme_support('post-thumbnails');
    add_image_size('medium', 300, 300, true);
}
add_action('after_setup_theme', 'iwc_theme_setup');

function inner_works_enqueue_styles() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css');
}

function inner_works_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js', array(), null, true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery', 'bootstrap-js'), null, true);
}

add_action('wp_enqueue_scripts', 'inner_works_enqueue_styles');
add_action('wp_enqueue_scripts', 'inner_works_enqueue_scripts');

add_action('phpmailer_init', 'configure_smtp');
function configure_smtp(\PHPMailer\PHPMailer\PHPMailer $phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 465;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Username = 'litaoakes2@gmail.com';
    $phpmailer->Password = 'urbk hlzj udtm xumg';
    $phpmailer->From = 'admin@innerworkscounselling.com.au';
    $phpmailer->FromName = 'Inner Works Counselling';
    $phpmailer->addReplyTo('admin@innerworkscounselling.com.au', 'Inner Works Counselling');

}

function inner_works_create_contacts_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            first_name tinytext NOT NULL,
            last_name tinytext NOT NULL,
            phone text NOT NULL,
            email text NOT NULL,
            message text NOT NULL,
            is_sent tinyint(1) NOT NULL DEFAULT 0,
            date_added datetime NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    } else {
        $column_exists = $wpdb->get_results("SHOW COLUMNS FROM `$table_name` LIKE 'date_added'");
        if (empty($column_exists)) {
            $wpdb->query("ALTER TABLE $table_name ADD date_added datetime NOT NULL");
        }
    }
}

add_action('init', 'inner_works_create_contacts_table');

function inner_works_contacts_menu() {
    add_menu_page(
        'Contacts',
        'Contacts',
        'manage_options',
        'contacts',
        'inner_works_contacts_page',
        'dashicons-id',
        6
    );
}
add_action('admin_menu', 'inner_works_contacts_menu');

function inner_works_contacts_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";

    if (isset($_POST['new'])) {
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        $is_sent = isset($_POST['is_sent']) ? 1 : 0;

        $result = $wpdb->insert(
            $table_name,
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'email' => $email,
                'message' => $message,
                'is_sent' => $is_sent,
                'date_added' => current_time('mysql'), // Insert current date and time
            ]
        );

        if ($result === false) {
            echo '<div class="error"><p>Error inserting data: ' . $wpdb->last_error . '</p></div>';
        } else {
            echo '<div class="updated"><p>Contact added successfully.</p></div>';
        }
    }

    if (isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        $is_sent = isset($_POST['is_sent']) ? 1 : 0;

        $result = $wpdb->update(
            $table_name,
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'email' => $email,
                'message' => $message,
                'is_sent' => $is_sent,
                'date_added' => current_time('mysql'), // Update date when edited
            ],
            ['id' => $id]
        );

        if ($result === false) {
            echo '<div class="error"><p>Error updating data: ' . $wpdb->last_error . '</p></div>';
        } else {
            echo '<div class="updated"><p>Contact updated successfully.</p></div>';
            echo '<script>window.location.href="?page=contacts";</script>';
            exit;
        }
    }

    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $wpdb->delete($table_name, ['id' => $id]);
    }

    if (isset($_POST['export'])) {
        $contacts = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

        if ($contacts) {
            $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';
            $filepath = wp_upload_dir()['path'] . '/' . $filename;

            $output = fopen($filepath, 'w');
            fputcsv($output, array('First Name', 'Last Name', 'Phone', 'Email', 'Message', 'Was Sent Tips', 'Date Added'));

            foreach ($contacts as $contact) {
                fputcsv($output, [
                    $contact['first_name'],
                    $contact['last_name'],
                    $contact['phone'],
                    $contact['email'],
                    $contact['message'],
                    $contact['is_sent'] ? 'Yes' : 'No',
                    $contact['date_added'],
                ]);
            }
            fclose($output);

            $file_url = wp_upload_dir()['url'] . '/' . $filename;
            echo '<div class="updated"><p>Contacts exported successfully. <a href="' . esc_url($file_url) . '" download>Download CSV</a></p></div>';
        }
    }

    $contacts = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap">';
    echo '<h2>Contacts</h2>';
    echo '<form method="post"><button type="submit" name="export" class="button button-primary">Export Contacts</button></form>';
    echo '<div class="responsive-container" style="display: flex; flex-wrap: wrap; gap: 20px;">';

    if (isset($_GET['edit'])) {
        $id = intval($_GET['edit']);
        $contact = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");

        echo '<div style="flex: 0.5; min-width: 300px;">';
        echo '<h2>Edit Contact</h2>';
    } else {
        echo '<div style="flex: 0.5; min-width: 300px;">';
        echo '<h2>Add New Contact</h2>';
        $contact = null;
    }
    ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo isset($contact) ? $contact->id : ''; ?>">
        <div style="margin-bottom: 10px;">
            <label style="width: 100px; display: inline-block;">First Name</label>
            <input type="text" name="first_name" value="<?php echo isset($contact) ? esc_attr($contact->first_name) : ''; ?>" style="width: 100%;">
        </div>
        <div style="margin-bottom: 10px;">
            <label style="width: 100px; display: inline-block;">Last Name</label>
            <input type="text" name="last_name" value="<?php echo isset($contact) ? esc_attr($contact->last_name) : ''; ?>" style="width: 100%;">
        </div>
        <div style="margin-bottom: 10px;">
            <label style="width: 100px; display: inline-block;">Phone</label>
            <input type="text" name="phone" value="<?php echo isset($contact) ? esc_attr($contact->phone) : ''; ?>" style="width: 100%;">
        </div>
        <div style="margin-bottom: 10px;">
            <label style="width: 100px; display: inline-block;">Email</label>
            <input type="email" name="email" value="<?php echo isset($contact) ? esc_attr($contact->email) : ''; ?>" style="width: 100%;">
        </div>
        <div style="margin-bottom: 10px;">
            <label style="width: 100px; display: inline-block;">Message</label>
            <textarea name="message" style="width: 100%; height: 100px;"><?php echo isset($contact) ? esc_textarea($contact->message) : ''; ?></textarea>
        </div>
        <div style="margin-bottom: 10px;">
            <label style="width: 100px; display: inline-block;">Was Sent Tips</label>
            <input type="checkbox" name="is_sent" <?php echo isset($contact) && $contact->is_sent ? 'checked' : ''; ?>>
        </div>
        <p><input type="submit" name="<?php echo isset($contact) ? 'update' : 'new'; ?>" value="<?php echo isset($contact) ? 'Update' : 'Add New'; ?>"></p>
    </form>
    <?php
    echo '</div>';

    echo '<div style="flex: 3; min-width: 300px;">';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th>Message</th><th>Was Sent Tips</th><th>Date Added</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    foreach ($contacts as $contact) {
        echo '<tr>';
        echo '<td>' . esc_html($contact->first_name) . '</td>';
        echo '<td>' . esc_html($contact->last_name) . '</td>';
        echo '<td>' . esc_html($contact->phone) . '</td>';
        echo '<td>' . esc_html($contact->email) . '</td>';
        echo '<td>' . esc_html($contact->message) . '</td>';
        echo '<td>' . esc_html($contact->is_sent ? 'Yes' : 'No') . '</td>';
        echo '<td>' . esc_html($contact->date_added) . '</td>';
        echo '<td><a href="?page=contacts&edit=' . $contact->id . '">Edit</a> | <a href="?page=contacts&delete=' . $contact->id . '" onclick="return confirm(\'Delete contact?\');">Delete</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    echo '</div>';
    echo '</div>';

    echo '<style>
.responsive-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.responsive-container > div {
    min-width: 300px;
}

@media (max-width: 768px) {
    .responsive-container {
        flex-direction: column;
    }

    .responsive-container > div {
        flex: 1 1 100%;
    }
}
</style>';
}
function rename_wpbot_menu_item() {
    global $menu;

    foreach ($menu as $key => $item) {
        if ($item[0] === 'ChatBot WPBot Lite') {
            $menu[$key][0] = 'ChatBot';
        }
    }
}
add_action('admin_menu', 'rename_wpbot_menu_item', 999);
?>
