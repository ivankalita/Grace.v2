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
    
    <nav class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="<?php echo home_url(); ?>">
                <img width="120" src="<?php echo get_field('logo'); ?>" alt="Логотип студии восточных танцев 'Грация'">
            </a>
        </div>
            
        <a class="header-menu-toggle" href="#0"><span>Menu</span></a>

        <div class="header-nav-wrap">
        <?php 
            wp_nav_menu( [
                'theme_location'  => 'top',
                'container'       => false, 
                'menu_class'      => 'header-nav', 
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
    
    
    <header id="header" class="s-home parallax-window vh-100" data-parallax="scroll" data-image-src="<?php the_field('header_image'); ?>">
        <div class="home-content">
            <div class="home-content__main">
                <div class="home-content_banner d-none d-xl-block">
                    <?php if(get_post_meta($post -> ID, 'header_banner', true)) {?>
                        <h1 class="text-right"><?php echo get_post_meta($post -> ID, 'header_banner', true); ?></h1>
                    <?php }?>
                </div>
            
                <div class="home-content__buttons">
                    <?php if(get_post_meta($post -> ID, 'btn_write', true)) {?>
                        <a href="#request" class="btn-write data-scroll"><?php echo get_post_meta($post -> ID, 'btn_write', true); ?></a>
                    <?php }?>
                </div>
                        
                <div class="home-content__scroll">
                    <a href="#leader" class="btn-next data-scroll">
                        ДАЛЕЕ<i class="im im-angle-down align-bottom icon-next"></i>
                    </a>
                </div>
            </div>
        </div>
            <?php
                $socials = get_field('header_social');
                if( $socials ): ?>
                <ul class="home-social d-none d-xl-block">
                    <?php foreach( $socials as $social ): ?>
                        <li><?php echo $social; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        
    </header>

<?php }?>