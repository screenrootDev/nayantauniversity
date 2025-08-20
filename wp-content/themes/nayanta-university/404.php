<?php
/* Template Name: Sitemap */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<style>
.sitemap{
   min-height:calc(100vh - 404px);
}
</style>
    <section class="section section-inner-hero sitemap">
        <div class="container">
            <div class="row gy-4">
                <div class="col-12">
                    <h1>Sorry!</h1>
                    <h4>We couldn't find the page you were looking for.</h4>
                    <p><span class="emoji">😞</span> Don't worry, you can go back to the <a href="/">Homepage</a> or check out some of our other pages!</p>
                </div>
            </div>
        </div>
  </section>

<?php get_footer(); ?>