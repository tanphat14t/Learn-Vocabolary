<?php /* Template Name: Page check Vocablaries */ ?>
<?php get_header(); ?>

<?php the_post(); ?>

<main id="check-vocablaries">
    <section class="section-check-vocab">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vocablaries</th>
                                <th scope="col">Phonetic</th>
                                <th scope="col">Word Type</th>
                                <th scope="col">Mean vietnamese</th>
                                <th scope="col">Answer</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vocabularies = get_posts(array(
                                'post_type' => 'vocabularies',
                                'posts_per_page' => 10, 
                                'post_status' => 'publish', 
                                'orderby' => "rand",
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
                                <tr class="row-box">
                                    <th scope="row"><?php echo $key + 1 ?></th>
                                    <td class="hidden-vocab">
                                        <input type="text" data-vocab="<?php echo ucwords(get_the_title($vocab_id)) ?>" placeholder=".......................................">
                                    </td>
                                    <td class="phonetic"><span><?php echo $phonetic; ?></span></td>
                                    <td><?php echo $type ?></td>
                                    <td><?php echo $mean ?></td>
                                    <td class="answer"><a href="" class="show-answer" data-vocab="<?php echo ucwords(get_the_title($vocab_id)) ?>">Show</a></td>
                                    <td><a href="" class="check-vocab">Check</a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="box-button d-flex">
                        <button class="clear">Clear</button>
                        <button class="check-all">Check All Vocab</button>
                        <button class="next">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>


<?php get_footer(); ?>