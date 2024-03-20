<?php
/*
Plugin Name: Custom Post Type
Description: this is costom post type
Author: Parwinder Singh
Version: 3.3
*/

/**
 * Register a custom post type called "student".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_student_init()
{
    $labels = array(
        'name'                  => __('Students'),
        'singular_name'         => __('Student'),
        'menu_name'             => __('Students'),
        'name_admin_bar'        => __('Student'),
        'add_new'               => __('Add New'),
        'add_new_item'          => __('Add New Student'),
        'new_item'              => __('New Student'),
        'edit_item'             => __('Edit Student'),
        'view_item'             => __('View Student'),
        'all_items'             => __('All Students'),
        'search_items'          => __('Search Students'),
        'parent_item_colon'     => __('Parent Students:'),
        'not_found'             => __('No Students found.'),
        'not_found_in_trash'    => __('No Students found in Trash.'),
        'featured_image'        => __('Student Cover Image'),

    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'student'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail'),
    );

    register_post_type('student', $args);
}

add_action('init', 'wpdocs_codex_student_init');

function wg_student_register_metabox()
{
    add_meta_box(
        "cpt-id",
        "Student",
        "wg_cpt_student_call_back",
        'student',
        "side",
        "high"
    );
}
add_action("add_meta_boxes", "wg_student_register_metabox");
function wg_cpt_student_call_back($post)
{
?>
    <p>
        <label>Email:</label>
        <?php $name = get_post_meta($post->ID, "student_email", true) ?>
        <input type="text" name="studentEmail" placeholder="Email" value="<?php echo $name ?>" />
    </p>
<?php
}
function wg_cpt_save_values($post_id, $post)
{
    $studentEmail = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : "";
    update_post_meta($post_id, "student_email", $studentEmail);
}
add_action("save_post", "wg_cpt_save_values", 10, 2);
