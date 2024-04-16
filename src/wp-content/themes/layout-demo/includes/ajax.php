<?php
add_action('wp_ajax_add_vocab', 'add_vocab');
add_action('wp_ajax_nopriv_add_vocab', 'add_vocab');

function add_vocab()
{
    $post_id = '';
    $response = array();
    $vocablary = $_POST['vocab'] ? ucwords($_POST['vocab']) : '';
    $phonetic = $_POST['phonetic'] ?? '';
    $wordtype = $_POST['wordtype'] ?? '';
    $meanVietnamese = $_POST['meanvietnamese'] ?? '';
    if ($vocablary && $meanVietnamese) {
        $arr_vocab = get_all_name_and_wordtype();

        if (count($arr_vocab) > 0) {
            if (isset($arr_vocab[$vocablary]) && $arr_vocab[$vocablary]['taxonomy'][0] == $wordtype) {

                $post_id = $arr_vocab[$vocablary]['id'];
                update_field('phonetic', $phonetic, $post_id);
                update_field('vietnamese_meaning', $meanVietnamese, $post_id);
                if ($post_id) {
                    $response = array('success' => true, 'message' => 'Vocabulary updated successfully');
                } else {
                    $response = array('success' => false, 'message' => 'Failed to update vocabulary');
                }
            } else {
                $post_data = array(
                    'post_title'    => $vocablary,
                    'post_type'     => 'vocabularies', // Tên của post type
                    'post_status'   => 'publish'
                );

                // Tạo bài viết mới
                $post_id = wp_insert_post($post_data);
                // Lưu giá trị vào trường ACF
                update_field('phonetic', $phonetic, $post_id);
                update_field('vietnamese_meaning', $meanVietnamese, $post_id);

                add_taxonomy_function($post_id, $wordtype, 'word_type');

                if ($post_id) {
                    $response = array('success' => true, 'message' => 'Vocabulary added successfully');
                } else {
                    $response = array('success' => false, 'message' => 'Failed to add vocabulary');
                }
            }
        } else {

            $post_data = array(
                'post_title'    => $vocablary,
                'post_type'     => 'vocabularies', // Tên của post type
                'post_status'   => 'publish'
            );

            $post_id = wp_insert_post($post_data);
            update_field('phonetic', $phonetic, $post_id);
            update_field('vietnamese_meaning', $meanVietnamese, $post_id);

            add_taxonomy_function($post_id, $wordtype, 'word_type');

            if ($post_id) {
                $response = array('success' => true, 'message' => 'Vocabulary added successfully');
            } else {
                $response = array('success' => false, 'message' => 'Failed to add vocabulary');
            }
        }
    }
    wp_send_json_success($response);
    wp_die();
}
add_action('wp_ajax_next_vocab', 'next_vocab');
add_action('wp_ajax_nopriv_next_vocab', 'next_vocab');

function next_vocab()
{
    $offset = $_POST['offset'] ?? '';
    $vocabularies = get_posts(array(
        'post_type' => 'vocabularies',
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'orderby' => "rand",
        'order' => 'ASC',
        'offset' => $offset
    )); ?>
    <?php foreach ($vocabularies as $key => $vocabulary) : ?>
        <?php
        $vocab_id = $vocabulary->ID;
        $phonetic = get_field('phonetic', $vocab_id);
        $type = "";
        $mean = get_field('vietnamese_meaning', $vocab_id);
        $word_types = wp_get_post_terms($vocab_id, 'word_type', array('fields' => 'names'));

        foreach ($word_types as $word_type) {
            $type = $word_type;
            break;
        }
        ?>
        <tr class="row-box">
            <th scope="row"><?php echo $key + 1 ?></th>
            <td class="hidden-vocab">
                <input type="text" data-vocab="<?php echo ucwords(get_the_title($vocab_id)) ?>" placeholder=".......................................">
            </td>
            <td class="phonetic"><span><?php echo $phonetic; ?></span></td>
            <td><?php echo $type ?></td>
            <td><?php echo $mean ?></td>
            <td><a href="" class="check-vocab">Check</a></td>
        </tr>
    <?php endforeach ?>
    <?php
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_search_vocab', 'search_vocab');
add_action('wp_ajax_nopriv_search_vocab', 'search_vocab');

function search_vocab()
{
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    $args = array(
        'post_type'      => 'vocabularies',
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
        's'              => $key,

    );
    $count = 0;
    $vocabularies = new WP_Query($args);
    // echo '<pre>';
    // var_dump($vocabularies);
    // echo '</pre>';
    if ($vocabularies->have_posts()) {
        while ($vocabularies->have_posts()) {
            $vocabularies->the_post(); ?>
            <?php
            $vocab_id = get_the_ID();
            $phonetic = get_field('phonetic', $vocab_id);
            $type = "";
            $mean = get_field('vietnamese_meaning', $vocab_id);
            $word_types = wp_get_post_terms($vocab_id, 'word_type', array('fields' => 'names'));

            foreach ($word_types as $word_type) {
                $type = $word_type;
                break;
            }
            ?>
            <tr>
                <th scope="row"><?php echo $count + 1 ?></th>
                <td><?php echo ucwords(get_the_title($vocab_id)) ?></td>
                <td><?php echo $phonetic; ?></td>
                <td><?php echo $type ?></td>
                <td><?php echo $mean ?></td>
                <td>
                    <a href="" data-id="<?php echo $vocab_id ?>" class="delete">delete</a>
                    <a href="" data-id="<?php echo $vocab_id ?>" class="edit">edit</a>
                </td>
            </tr>
            <?php $count++; ?>
    <?php }
        wp_reset_postdata();
    } else {
        echo 'No result.';
    }
    ?>

    <?php
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_delete_vocab', 'delete_vocab');
add_action('wp_ajax_nopriv_delete_vocab', 'delete_vocab');

function delete_vocab()
{
    $vocabID = isset($_POST['vocabID']) ? $_POST['vocabID'] : '';
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    if ($vocabID) {
        if (get_post_type($vocabID) === 'vocabularies') {
            wp_delete_post($vocabID, true);
        }
    }
    $args = array(
        'post_type'      => 'vocabularies',
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    if ($key) {
        $args['s'] = $key;
    }
    $count = 0;
    $vocabularies = new WP_Query($args);
    if ($vocabularies->have_posts()) {
        while ($vocabularies->have_posts()) {
            $vocabularies->the_post(); ?>
            <?php
            $vocab_id = get_the_ID();
            $phonetic = get_field('phonetic', $vocab_id);
            $type = "";
            $mean = get_field('vietnamese_meaning', $vocab_id);
            $word_types = wp_get_post_terms($vocab_id, 'word_type', array('fields' => 'names'));

            foreach ($word_types as $word_type) {
                $type = $word_type;
                break;
            }
            ?>
            <tr>
                <th scope="row"><?php echo $count + 1 ?></th>
                <td><?php echo ucwords(get_the_title($vocab_id)) ?></td>
                <td><?php echo $phonetic; ?></td>
                <td><?php echo $type ?></td>
                <td><?php echo $mean ?></td>
                <td>
                    <a href="" data-id="<?php echo $vocab_id ?>" class="delete">delete</a>
                    <a href="" data-id="<?php echo $vocab_id ?>" class="edit">edit</a>
                </td>
            </tr>
            <?php $count++; ?>
    <?php }
        wp_reset_postdata();
    } else {
        echo 'No result.';
    }
    ?>

<?php
    wp_reset_postdata();
    wp_die();
}

function add_taxonomy_function($post_id, $term_name, $tax)
{
    if ($term_name != '') {
        $term_data = array(
            'term_name' => $term_name,
            'taxonomy'  => $tax,
        );

        $term_exists = term_exists($term_data['term_name'], $term_data['taxonomy']);

        if (!$term_exists) {
            $term = wp_insert_term($term_data['term_name'], $term_data['taxonomy']);

            if (!is_wp_error($term)) {

                // wp_set_object_terms($post_id, null, $term_data['taxonomy']);

                wp_set_object_terms($post_id, $term['term_id'], $term_data['taxonomy'], true);
            } else {
                echo 'Error adding term: ' . $term->get_error_message();
            }
        } else {
            $existing_term = get_term_by('name', $term_data['term_name'], $term_data['taxonomy']);

            if ($existing_term) {
                // Assign the existing term to the post
                wp_set_object_terms($post_id, $existing_term->term_id, $term_data['taxonomy'], true);
            }
        }
    }
}
add_action('init', 'get_all_name_and_wordtype');
function get_all_name_and_wordtype()
{
    $vocabularies_info = array();

    $vocabularies = get_posts(array(
        'post_type' => 'vocabularies',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));

    foreach ($vocabularies as $vocabulary) {
        $name = $vocabulary->post_title;
        $id = $vocabulary->ID;
        $taxonomy = wp_get_post_terms($vocabulary->ID, 'word_type', array('fields' => 'names'));

        $vocabularies_info[$name] = array(
            'id' => $id,
            'taxonomy' => $taxonomy
        );
    }



    return $vocabularies_info;
}
