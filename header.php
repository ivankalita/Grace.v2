<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo(name); ?></title>
    
    <?php wp_head() ?>
    <style>
    .loaderArea {
        background: #353232;
        overflow: hidden;
        position: fixed;
        left: 0;
        top: 0;
        right:0;
        bottom:0;
        z-index: 1000;
        transition: 1.8s all linear;
        transition-delay: .5s;
    }
    .loader {
        position: fixed;
        width: 3rem;
        height: 3rem;
        top: 50%;
        left: 50%;
        color: #AF2B2B;
        transition: .8s all linear;
        /* z-index: 500; */
    }
    .visible {
        visibility: visible;
        opacity: 1;
    }
    .hidden {
        visibility: hidden;
        opacity: 0;
    }
    </style>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", NProgress.start());
        window.onload = function() {
            setTimeout(function() {
                var loaderEl = document.querySelector(".loader");
                var loaderAreaEl = document.querySelector(".loaderArea");

                NProgress.done();
                loaderEl.classList.add('hidden');
                loaderEl.classList.remove('visible');
                loaderAreaEl.style.background = 'transparent';
                loaderAreaEl.remove();
            }, 1000);
        }
    </script>

    <div class="loaderArea">
        <div class="spinner-grow loader visible" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    
    </div>
    <?php if(is_front_page()) {?>
    
    <nav class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="<?php echo home_url(); ?>">
                <img src="<?php echo get_field('logo'); ?>" alt="Логотип студии восточных танцев 'Грация'">
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
                        <li>
                            <!-- <a href="https://vk.com/id152043235"> -->
                            <?php echo $social; ?>
                            <!-- </a> -->
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        
    </header>

<?php }?>