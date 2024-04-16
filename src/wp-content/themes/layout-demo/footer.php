<?php
$footer_nav_menu = wp_nav_menu([
    'theme_location' => 'footer',
    'fallback_cb' => false,
    'echo' => false,
]);
$privacy_nav_menu = wp_nav_menu([
    'theme_location' => 'max_mega_menu_2',
    'fallback_cb' => false,
    'echo' => false,
]);

$logo_footer = get_field('logo-header', 'option'); //get_post_thumbnail_id();
$size = 'full';
?>
<footer id="footer" class="footer">
    <div class="container-fluid">
        <div class="row wrapper">
            <div class="col-12 col-lg-6">
                <div class="logo-footer d-lg-block d-none">
                    <?php
                    if ($logo_footer) {
                        echo wp_get_attachment_image($logo_footer, $size, "", array("class" => "img-fluid logo-img"));
                    }
                    ?>
                </div>
                <div class="infor-contact">
                    <div class="infor phone">
                        <p class="title">Phone</p>
                        <a href="tel: 0123456789" title="number-phone">01233456789</a>
                    </div>
                    <div class="infor hours">
                        <p class="title">Hours</p>
                        <p>Mon – Fri, 8:30 AM – 5 PM</p>
                    </div>
                    <div class="infor social">
                        <p class="title">Social</p>
                        <div class="box-social">
                            <a class="social-link" href="https://www.facebook.com/Smarterlite" target="_blank" title="">
                                <img width="626" height="626" src="https://smarterlite.com/wp-content/uploads/2023/11/y.png" class="img-fluid" alt="" decoding="async" loading="lazy" srcset="https://smarterlite.com/wp-content/uploads/2023/11/y.png 626w, https://smarterlite.com/wp-content/uploads/2023/11/y-300x300.png 300w, https://smarterlite.com/wp-content/uploads/2023/11/y-150x150.png 150w" sizes="(max-width: 626px) 100vw, 626px">
                            </a>
                            <a class="social-link" href="https://www.youtube.com/@polarenviro" target="_blank" title="">
                                <img width="1024" height="788" src="https://smarterlite.com/wp-content/uploads/2023/11/f.png" class="img-fluid" alt="" decoding="async" loading="lazy" srcset="https://smarterlite.com/wp-content/uploads/2023/11/f.png 1024w, https://smarterlite.com/wp-content/uploads/2023/11/f-300x231.png 300w, https://smarterlite.com/wp-content/uploads/2023/11/f-768x591.png 768w" sizes="(max-width: 1024px) 100vw, 1024px">
                            </a>
                            <a class="social-link" href="https://www.linkedin.com/company/smarterlite" target="_blank" title="">
                                <img width="512" height="512" src="https://smarterlite.com/wp-content/uploads/2023/11/in.png" class="img-fluid" alt="" decoding="async" loading="lazy" srcset="https://smarterlite.com/wp-content/uploads/2023/11/in.png 512w, https://smarterlite.com/wp-content/uploads/2023/11/in-300x300.png 300w, https://smarterlite.com/wp-content/uploads/2023/11/in-150x150.png 150w" sizes="(max-width: 512px) 100vw, 512px">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer__copyright">
                    <p>©2023 All Rights Reserved — Smarterlite Pty Ltd</p>
                    <div class="footer__privacy d-block d-lg-none">
                        <?php echo $privacy_nav_menu; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 column-right">
                <div class="trademark d-block d-lg-none">
                    <?php
                    if ($logo_footer) {
                        echo wp_get_attachment_image($logo_footer, $size, "", array("class" => "img-fluid logo-img"));
                    }
                    ?>
                </div>
                <div class="form-contact">
                    <p>Start your Smarterlite journey. Sign up to our newsletter now.</p>
                    <?php echo do_shortcode('[formidable id=1]') ?>
                </div>
                <div class="wrapper-menu-item">
                    <?php echo $footer_nav_menu; ?>
                </div>
                <div class="footer__privacy d-none d-lg-block">
                    <?php echo $privacy_nav_menu; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- modal login -->
<div class="modal fade modal-login" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="login-form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control login-username" id="exampleInputEmail1" aria-describedby="userHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control login-pass" id="exampleInputPassword1">
                    </div>
                    <div class="form-group p-0">
                        <a class="btn-register" href="">Register</a>
                    </div>
                    <button type="submit" data-pageId="<?php echo get_the_id() ?>" class="btn btn-primary submit-login">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal register -->
<div class="modal fade modal-register" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Username</label>
                        <input type="text" class="form-control username" id="exampleInputEmail2" aria-describedby="userHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Password</label>
                        <input type="password" class="form-control pass" id="exampleInputPassword2">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Password again</label>
                        <input type="password" class="form-control pass-again" id="exampleInputPassword3">
                    </div>
                    <div class="form-group p-0">
                        <a class="btn-login" href="">Login</a>
                    </div>
                    <button type="submit" class="btn btn-primary submit-register">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal_noti" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Vocablary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="noti"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>

</body>

</html>