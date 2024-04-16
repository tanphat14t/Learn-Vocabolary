<?php /* Template Name: Page Download */ ?>
<?php get_header(); ?>

<?php the_post(); ?>

<main id="download">
    <?php $url_file_download = get_field('file_download', get_the_id())?>
    <section class="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="box-image">
                        <?php
                        $image = get_post_thumbnail_id();
                        $size = 'large'; // (thumbnail, medium, large, full or custom size)
                        if ($image) {
                            echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid"));
                        } else {
                            //show image default
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="box-content">
                        <div class="content-top">
                            <h2 class="content_title">
                                <?php echo get_the_title() ?>
                            </h2>
                            <p class="content_content">
                                <?php the_content(); ?>
                            </p>
                        </div>
                        <div class="content-bottom">
                            <?php if (!is_user_logged_in()) : ?>
                                <button type="button" class="btn btn-primary btn-download"  data-toggle="modal" data-target="#exampleModal">
                                    <?php include get_stylesheet_directory() . '/assets/imgs/icons/download.svg'; ?>
                                    <span>Download File</span>
                                </button>
                            <?php else : ?>
                                <a class="d-flex align-items-center btn-download" href="<?php echo $url_file_download ?>" download>
                                    <?php include get_stylesheet_directory() . '/assets/imgs/icons/download.svg'; ?>
                                    <span>Download File</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>


<?php get_footer(); ?>