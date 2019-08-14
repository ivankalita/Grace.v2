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
    
    <nav class="container-fluid">
        <div class="row h-100 preheader">

            <div class="col-auto h-100 header-logo">
                <a class="href-logo h-100" href="<?php echo home_url(); ?>">
                    <img width="120" src="<?php echo get_option('logo'); ?>" alt="Логотип студии восточных танцев 'Грация'">
                </a>
            </div>
            
            <div class="col d-block d-xl-none header-menu-toggle">
                    <a id="hamburger-icon">
                        <span class="line line-1"></span>
                        <span class="line line-2"></span>
                        <span class="line line-3"></span>
                    </a>
            </div>

            <div class="col nav-block">
            <?php 
                wp_nav_menu( [
                    'theme_location'  => 'top',
                    'container'       => false, 
                    'menu_class'      => 'navbar h-100 justify-content-end', 
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
        </div>    
    </nav>
    
    
    <header class="vh-100 parallax-window" data-parallax="scroll" data-image-src="<?php the_field('header_image'); ?>">
        <div class="container-fluid header-banner d-none d-xl-block">
            <div class="row justify-content-end mx-4">
                <?php if(get_post_meta($post -> ID, 'header_banner', true)) {?>
                    <h1 class="text-right"><?php echo get_post_meta($post -> ID, 'header_banner', true); ?></h1>
                <?php }?>
            </div>
        </div>
       
        <div class="container-fluid header-extra pt-3">
            <div class="row h-25 align-content-center">
                <div class="col block-write mr-4 text-xl-right text-left">
                    <?php if(get_post_meta($post -> ID, 'btn_write', true)) {?>
                        <a href="#request" class="btn-write"><?php echo get_post_meta($post -> ID, 'btn_write', true); ?></a>
                    <?php }?>
                </div>
                
            </div>
            <div class="row header-extra-next h-75 ">
                <div class="col align-self-end p-5">
                    <a href="#leader" class="btn-next">
                        ДАЛЕЕ<i class="im im-angle-down align-bottom icon-next"></i>
                    </a>
                </div>
                <div class="col align-self-center justify-content-end d-none d-xl-flex text-center p-5">
                    <?php
                        $socials = get_field('header_social');
                        if( $socials ): ?>
                        <ul class="social-list">
                            <?php foreach( $socials as $social ): ?>
                                <li><?php echo $social; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </header>

<?php }?>