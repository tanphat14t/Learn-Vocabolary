<?php /* Template Name: Page Vocablaries */ ?>
<?php get_header(); ?>

<?php the_post(); ?>

<main id="vocablaries">
    <section class="list-vocab">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="search-vocab">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="vocablory" placeholder="Find Vocablary">
                        </div>
                        <!-- <button type="submit" class="btn btn-primary mb-2 vietnamese">Find Vocablory With Vietnamese</button> -->
                        <button type="submit" class="btn btn-primary mb-2">Find Vocablory</button>
                    </form>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vocablaries</th>
                                <th scope="col">Phonetic</th>
                                <th scope="col">Word Type</th>
                                <th scope="col">Mean vietnamese</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vocabularies = get_posts(array(
                                'post_type' => 'vocabularies',
                                'posts_per_page' => -1,
                                'post_status' => 'publish',
                                'orderby' => "title",
                                'order' => 'ASC',
                            ));
                            ?>
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
                                <tr>
                                    <th scope="row"><?php echo $key + 1 ?></th>
                                    <td><?php echo ucwords(get_the_title($vocab_id)) ?></td>
                                    <td><?php echo $phonetic; ?></td>
                                    <td><?php echo $type ?></td>
                                    <td><?php echo $mean ?></td>
                                    <td>
                                        <a href="" data-id="<?php echo $vocab_id ?>" class="delete">delete</a>
                                        <a href="" data-id="<?php echo $vocab_id ?>" class="show-popup-edit">edit</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="updateVocab" tabindex="-1" aria-labelledby="updateVocabLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVocabLabel">Update Vocablary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update-vocab">
                        <div class="form-group">
                            <label for="vocab">Vocablary</label>
                            <input type="text" class="form-control" id="vocab" placeholder="Enter vocablary" name="vocab" aria-describedby="vocablary">
                        </div>
                        <div class="form-group">
                            <label for="phonetic">Phonetic</label>
                            <input type="text" class="form-control" id="phonetic" placeholder="Enter phonetic" name="phonetic">
                        </div>
                        <div class="form-group">
                            <?php
                            $terms = get_terms(array(
                                'taxonomy' => 'word_type',
                                'hide_empty' => false,
                            ));
                            if (!empty($terms)) :
                            ?>
                                <label for="wordtype">Word Type</label>

                                <select class="form-control" id="wordtype" name="wordtype">
                                    <option selected>Choose Wordtype</option>
                                    <?php
                                    foreach ($terms as $term) {
                                        echo '<option value="' . $term->name . '">' . $term->name . '</option>';
                                    }
                                    ?>

                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="mean-vietnamese">Mean vietnamese</label>
                            <input type="text" class="form-control" id="mean_vietnamese" placeholder="Enter mean vietnamese" name="meanvietnamese">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update">Update</button>
                </div>
            </div>
        </div>
    </div>
</main>


<?php get_footer(); ?>