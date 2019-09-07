<footer class="container-fluid py-3">
        <div class="row justify-content-center">
            <a href="<?php echo home_url(); ?>">
                <img class="footer__logo" width="150" src="<?php echo get_field('logo'); ?>" alt="Логотип студии восточных танцев 'Грация'">  
            </a>
        </div>
        <div class="row mt-3">
            <div class="col copyright-hightlight align-middle">
                <h5 class="text-right my-auto"><i class="far fa-copyright icon-copyright"></i><?php echo get_field('copyright_footer');?><span class="footer-name-title">Grace.</span> 2019</h5>
            </div>
            <div class="col align-middle creater-sign">
                <h5 class="my-auto">Design by <span class="footer-name-title"><?php echo get_field('creator');?></span></h5>
            </div>
        </div>
</footer>

<?php wp_footer() ?>

</body>
</html>