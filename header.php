<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo(name); ?></title>

    <?php wp_head() ?>
</head>
<body>
    <?php if(is_front_page()) {?>
    <header class="vh-100 parallax-window" data-parallax="scroll" data-image-src="<?php the_field('header_image'); ?>">
        <nav class="navbar navbar-expand-xl navbar-dark">
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <img width="120" src="<?php echo get_option('logo'); ?>" alt="Логотип студии восточных танцев 'Грация'">
            </a>
            <button class="navbar-toggler d-xl-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <?php 
                    wp_nav_menu( [
                        'theme_location'  => 'top',
                        'container'       => false, 
                        'menu_class'      => 'navbar-nav ml-auto mt-2 mt-lg-0', 
                        'echo'            => true,
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => '',
                    ] );
                ?>
            </div>
        </nav>

        <div class="container-fluid header-banner">
            <div class="d-flex justify-content-end mr-4">
                <?php if(get_post_meta($post -> ID, 'header_banner', true)) {?>
                    <h1 class="text-right"><?php echo get_post_meta($post -> ID, 'header_banner', true); ?></h1>
                <?php }?>
            </div>
        </div>
       

        <div class="container-fluid pt-5 header-extra">
            <div class="row header-extra-next">
                <div class="col align-self-end p-5">
                    <a href="#leader" class="btn-next">
                        ДАЛЕЕ<i class="im im-angle-down align-bottom icon-next"></i>
                    </a>
                </div>
                <div class="col">
                    <div class="container-fluid h-100">
                        <div class="row justify-content-end h-25 mr-3 pt-25">
                            <?php if(get_post_meta($post -> ID, 'btn_write', true)) {?>
                                <a href="#request" class="btn-write"><?php echo get_post_meta($post -> ID, 'btn_write', true); ?></a>
                            <?php }?>
                        </div>
                        <div class="row social justify-content-end align-items-end h-75 pb-5 pr-5">
                        <?php

                            // vars	
                            $socials = get_field('header_social');


                            // check
                            if( $socials ): ?>
                            <ul>
                                <?php foreach( $socials as $social ): ?>
                                    <li><?php echo $social; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php }?>