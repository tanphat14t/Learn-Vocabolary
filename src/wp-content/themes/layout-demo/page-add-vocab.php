<?php /* Template Name: Page Add Vocablaries */ ?>
<?php get_header(); ?>

<?php the_post(); ?>
<?php
$page_id = get_the_id();
$bg_image = get_field('add_vocab_bg_image', $page_id)
?>
<main id="add-vocablaries">
    <section class="form-add-vocablaries" style="background-image: url('<?php echo $bg_image ?>')">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form id="add-vocab">
                        <h2 class="form-title">Add vocabloary</h2>
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>


<?php get_footer(); ?>