<?php 
/*Template Name: Главная */
get_header();
?>

    <div class="return-up">
        <a href="#header" class="data-scroll">
            <i class="im im-angle-up icon-up"></i>
        </a>    
    </div>


    <section id="leader" class="container-fluid leader target-section">
        <div class="row justify-content-center">
            <h1 class="leader-title"><?php the_field('leader_title'); ?></h1>
        </div>
        <div class="container mt-3 mt-md-5">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 photo-leader">
                <img class="img-leader" src="<?php the_field('leader_photo'); ?>">
                    <div class="photo-leader-detail">
                        <p class="mb-0">
                            Логвинова<br>
                            Василинна<br>
                            Игоревна
                        </p>
                    </div>
                </div>
                <div class="col col-12 col-md-6 mt-5 mt-md-0">
                    <p class="text-center leader-description">
                    <?php if(get_post_meta($post -> ID, 'about_me', true)) {?>
                        <?php echo get_post_meta($post -> ID, 'about_me', true); ?>
                    <?php }?> 
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section id="groups" class="container-fluid mt-5 groups target-section vh-xl-100">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center group-title"><?php the_field('group_title'); ?></h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="text-center section-descr group-description"><?php the_field('group_description'); ?></h3>     
            </div>
        </div>
        <div class="row carousel mt-2 mt-md-5">
            <div class="container carousel-block pt-3 pt-md-5 pb-3 mx-sm-auto">
                <?php $carousel = get_field('carousel_setting'); ?>
                <div class="row carousel-items h-100">
                    <div class="col-12 col-md-6 pr-md-5 my-auto">
                        <img  class="img-fluid" src="<?php echo $carousel["carousel_image1"]; ?>">
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-left my-auto">
                        <div class="row mt-2">
                            <h1 class="carousel-title d-inline-flex d-md-block"><?php echo $carousel["carousel_title1"]; ?></h1>
                        </div>
                        <div class="row groups-description">
                            <?php echo $carousel["carousel_text1"]; ?>
                        </div>                    
                    </div>
                </div>
                <div class="row carousel-items h-100">
                    <div class="col-12 col-md-6 order-2 order-md-1 text-center text-md-right my-auto">
                        <div class="row mt-2">
                            <h1 class="carousel-title"><?php echo $carousel["carousel_title2"]; ?></h1>
                        </div>
                        <div class="row groups-description">
                            <?php echo $carousel["carousel_text2"]; ?>
                        </div>                    
                    </div>
                    <div class="col-12 col-md-6 order-1 order-md-2 pr-md-5 my-auto">
                        <img  class="img-fluid" src="<?php echo $carousel["carousel_image2"]; ?>">
                    </div>
                </div>
                <div class="row carousel-items h-100">
                    <div class="col-12 col-md-6 pr-md-5 my-auto">
                        <img  class="img-fluid" src="<?php echo $carousel["carousel_image3"]; ?>">
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-left my-auto">
                        <div class="row mt-2">
                            <h1 class="carousel-title"><?php echo $carousel["carousel_title3"]; ?></h1>
                        </div>
                        <div class="row groups-description">
                            <?php echo $carousel["carousel_text3"]; ?>
                        </div>                    
                    </div>
                </div>
                <div class="row mt-2 mt-md-5">
                    <div class="col dots-block text-center">
                        <ion-icon class="dots-items active" name="radio-button-on"></ion-icon>
                        <ion-icon class="dots-items" name="radio-button-on"></ion-icon>
                        <ion-icon class="dots-items" name="radio-button-on"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
            
    </section>


    <section id="events" class="container-fluid mt-5 events target-section">
        <div class="row justify-content-center">
            <h1 class="text-center events-title"><?php the_field('events_title'); ?></h1>
        </div>
        <div class="row justify-content-center">
            <h3 class="text-center section-descr"><?php the_field('events_description'); ?></h3>
        </div>
        <div class="row mt-5">
            <div class="col">
                <ul class="timeline">
                <?php 
                    $args = array(
                        'numberposts' => 0,
                        'post_type' => 'post',
                        'suppress_filters' => true,
                    );

                    $posts = get_posts($args);

                    foreach($posts as $post) { setup_postdata($post);
                        

                ?>
                    <li>
                        <div class="timeline-image">
                            <img class="rounded-circle img-fluid" src="<?php the_post_thumbnail_url( $size ); ?>" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>
                                    <?php the_time('j F Y'); ?>
                                </h4>
                                <h4 class="subheading">
                                    <?php the_title(); the_ID(); ?>
                                </h4>
                            </div>
                            <div class="timeline-body">
                                <div class="timeline-description">
                                    <?php   $content = get_the_content();
                                            $postOutput = preg_replace('/(<)([img])(\w+)([^>]*>)/', "", $content);
                                            echo $postOutput;
                                    ?>
                                </div>
                                <div class="timeline-gallery"></div>
                            </div>
                        </div>
                    </li>

                    <?php };

                    wp_reset_postdata();

                    $published_posts = wp_count_posts()->publish;
                    $posts_per_page = get_option('posts_per_page');
                    $wp_query->max_num_pages = ceil($published_posts / $posts_per_page);

                    if (  $wp_query->max_num_pages > 1 ) : ?>
                    	<script>
                        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                        </script>
                    <?php endif; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
        
            <!-- <div class="timeline__showmore">
                показать ещё<i class="fas fa-angle-down icon-showmore pl-2"></i>
            </div> -->
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="timeline__showmore">
                    <span class="spinner-border spinner-border-sm wait__posts" role="status" aria-hidden="true"></span>
                    <span class="button__text text-nowrap">показать ещё</span>          
                </div>
            </div>
        </div>

    </section>


    <section id="gallery" class="container-fluid mt-5 gallery target-section">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center gallery-title"><?php the_field('gallery_title'); ?></h1>
            </div>
            <div class="row justify-content-center mb-5">
                <h3 class="text-center section-descr"><?php the_field('gallery_description'); ?></h3>
            </div>
            <?php echo do_shortcode('[rl_gallery id="300"]'); ?>
        </div>            
            
    </section>

    <?php echo get_template_directory_uri() . '/assets/images/schedule.jpg'; ?>
    <section id="schedule" class="schedule target-section parallax-window" data-parallax="scroll">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <h1 class="text-center schedule-title"><?php the_field('schedule_title'); ?></h1>
            </div>
            <div class="row justify-content-center mt-3">
                <h3 class="text-center schedule-descr"><?php the_field('schedule_description'); ?></h3>
            </div>
        </div>
        <div class="container">
            <div class="row mt-3 text-center">
                <?php $groups = get_field_object('schedule_select'); ?>
                <div class="col-12" style="z-index: 10">
                    <h3 class="schedule-change" data-collapse="true">
                        <?php echo $groups['label']; ?>
                        <i class="fas fa-caret-down select-triangle"></i>
                    </h3>
                </div>
                <div class="col-12">
                    <div class="row schedule-group text-center">
                        <?php foreach($groups['choices'] as $key => $group) { ?>
                        <div class="col-12">
                            <h3 class="schedule-choice"> 
                                <?php echo $group; ?>
                            </h3>
                        </div>
                        <?php }; ?>  
                    </div>
                </div>
            </div>
            <div class="spinner-grow wait__schedule" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="container-fluid" style="color: white; font-size: 48px;">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center monday day-of-week">
                        <div class="col-3 col-xl-12 day">ПН</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center tuesday day-of-week">
                        <div class="col-3 col-xl-12 day">ВТ</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center wednesday day-of-week">
                        <div class="col-3 col-xl-12 day">СР</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center thursday day-of-week">
                        <div class="col-3 col-xl-12 day">ЧТ</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center friday day-of-week">
                        <div class="col-3 col-xl-12 day">ПТ</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center saturday day-of-week">
                        <div class="col-3 col-xl-12 day">СБ</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl align-self-center">
                    <div class="row text-center sunday day-of-week">
                        <div class="col-3 col-xl-12 day">ВС</div>
                        <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center from"></div>
                        <div class="col-1 col-xl-12">-</div>
                        <div class="col-4 col-xl-12 text-left text-xl-center to"></div>
                    </div>
                </div>
            </div>
        </div>
        
       
    </section>


    <section id="contacts" class="container-fluid contacts target-section py-5">
        <div class="row">
            <div class="col-12 col-xl-6" id="request" >
                <div class="row justify-content-center">
                    <h1 class="text-center contacts-title">ЗАПИСЬ НА ЗАНЯТИЯ</h1>
                </div>
                <form class="row align-content-center h-100">
                    <div class="container">                        
                        <div class="row">
                            <input name="contactName" type="text" placeholder="Имя" minlength="2" required="" aria-required="true" class="form-input w-100">
                        </div>
                        <div class="row mt-3">
                            <input name="contactSurname" type="text"placeholder="Фамилия" minlength="2" required="" aria-required="true" class="form-input w-100">
                        </div>
                        <div class="row mt-3">
                            <div class="col-11 px-0 align-self-center">
                                <input name="contactAge" type="text"placeholder="Укажите Ваш возраст" minlength="1" required="" aria-required="true" class="form-input w-100">
                            </div>
                            <div class="col-1 px-0">
                                <div class="row">
                                    <div class="col text-right">
                                        <i class="im im-angle-up icon-count age-add"></i><br>
                                        <i class="im im-angle-down icon-count age-sub"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-11 px-0">
                                <input name="contactEmail" type="email" placeholder="Почта" minlength="2" required="" aria-required="true" class="form-input w-100 temp-contact">
                            </div>
                            <div class="col-1 px-0 text-right">
                                <ion-icon name="refresh" class="icon-refresh"></ion-icon>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <textarea name="contactMassage" rows="5" cols="30" wrap="soft" placeholder="Дополнительные данные, которые Вы бы хотели указать" class="w-100"></textarea>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col px-0">
                                <input type="submit" id="send" value="ОТПРАВИТЬ" class="form-input w-100">
                                <div class="spinner-grow wait__send" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-xl-6 mt-5 mt-xl-0" id="contacts">
                <div class="row justify-content-center">
                    <h1 class="text-center contacts-title">КОНТАКТЫ</h1>
                </div>
                <div class="row align-content-center h-100 text-center">
                    <div class="container contacts-descr">
                        <div class="row">
                            <div class="col-4 col-md text-left text-md-center">
                                <h3>Телефон</h3>
                            </div>
                            <div class="col-8 col-md">
                                <h4><?php echo the_field('phone_footer'); ?></h4>
                            </div>
                        </div>
                        <div class="row mt-2 mt-md-5">
                            <div class="col-4 col-md text-left text-md-center">
                                <h3>Почта</h3>
                            </div>
                            <div class="col-8 col-md">
                                <h4><?php echo the_field('mail_footer'); ?></h4>
                            </div>
                        </div>
                        <div class="row mt-2 mt-md-5">
                            <div class="col-4 col-md text-left text-md-center">
                                <h3>Адрес</h3>
                            </div>
                            <div class="col-8 col-md">
                                <h4><?php echo the_field('adress_footer'); ?></h4>
                            </div>
                        </div>
                        <div class="row mt-4 mt-md-5 text-center">
                            <?php
                                $socials = get_field('footer_social');
                                if( $socials ): ?>
                                    <?php foreach( $socials as $social ): ?>
                                        <div class="col social-contacts">
                                            <?php echo $social; ?>
                                        </div>
                                    <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        
                        <!-- <div class="row mt-4 mt-md-5 text-center">
                            <div class="col">
                                <i class="fab fa-vk social-contacts"></i>
                            </div>
                            <div class="col">
                                <i class="fab fa-odnoklassniki social-contacts"></i>
                            </div>
                            <div class="col">
                                <a class="cursor" href="#" data-toggle="modal" data-target="#modalRegular"><i class="fas fa-map-marker-alt social-contacts"></i></a>
                            </div>
                        </div> -->
                    </div>  
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalRegular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: auto;">
                <div class="modal-content">
                    <div class="modal-body mb-0 p-0 overflow-hidden">
                        <div id="map-container-google-16" class="z-depth-1-half map-container-9" >
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2403.3390441028546!2d36.07069047210828!3d52.96031501125605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41321a74211a181b%3A0xac6a8617932c6904!2z0YPQuy4g0JPQsNCz0LDRgNC40L3QsCwgMjMsINCe0YDRkdC7LCDQntGA0LvQvtCy0YHQutCw0Y8g0L7QsdC7LiwgMzAyMDAx!5e0!3m2!1sru!2sru!4v1555260906557!5m2!1sru!2sru"
                                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-info btn-md" data-dismiss="modal">Закрыть<i class="fas fa-times ml-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer() ?>