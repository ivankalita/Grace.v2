    <?php 
    /*Template Name: Главная */
    get_header();
    ?>



    <section id="leader" class="container-fluid leader target-section">
        <div class="row justify-content-center">
            <h1><?php the_field('leader_title'); ?></h1>
        </div>
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col photo-leader">
                <img class="img-leader" src="<?php the_field('leader_photo'); ?>">
                    <div class="photo-leader-detail">
                        <p class="mb-0">
                            Логвинова<br>
                            Василинна<br>
                            Игоревна
                        </p>
                    </div>
                </div>
                <div class="col ">
                    <p class="text-center leader-description">
                    <?php if(get_post_meta($post -> ID, 'about_me', true)) {?>
                        <?php echo get_post_meta($post -> ID, 'about_me', true); ?>
                    <?php }?> 
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section id="groups" class="container-fluid mt-5 groups target-section">
            <div class="row justify-content-center">
                <h1 class="text-center"><?php the_field('group_title'); ?></h1>
            </div>
            <div class="row justify-content-center">
                <h3 class="text-center section-descr"><?php the_field('group_description'); ?></h3>
            </div>
    </section>

    <div class="carousel container-fluid mt-5">
        <div class="carousel-block container pt-5 pb-3">
            <?php $carousel = get_field('carousel_setting'); ?>
            <div class="row carousel-items h-100">
                <div class="col-6 pr-5">
                    <img  class="img-fluid" src="<?php echo $carousel["carousel_image1"]; ?>">
                </div>
                <div class="col-6 text-left my-auto">
                    <div class="row">
                        <h1><?php echo $carousel["carousel_title1"]; ?></h1>
                    </div>
                    <div class="row mt-3">
                        <?php echo $carousel["carousel_text1"]; ?>
                    </div>                    
                </div>
            </div>
            <div class="row carousel-items h-100">
                <div class="col text-right my-auto">
                    <?php echo $carousel["carousel_text2"]; ?>
                </div>
                <div class="col">
                    <img class="img-fluid" src="<?php echo $carousel["carousel_image2"]; ?>">
                </div>
            </div>
            <div class="row carousel-items h-100">
                <div class="col">
                    <img class="img-fluid" src="<?php echo $carousel["carousel_image3"]; ?>">
                </div>
                <div class="col my-auto">
                    <?php echo $carousel["carousel_text3"]; ?>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col dots-block text-center">
                    <ion-icon class="dots-items active" name="radio-button-on"></ion-icon>
                    <ion-icon class="dots-items" name="radio-button-on"></ion-icon>
                    <ion-icon class="dots-items" name="radio-button-on"></ion-icon>
                </div>
            </div>
        </div>
    </div>
        
   
            


    <section id="events" class="container mt-5 events target-section">
        <div class="row justify-content-center">
            <h1 class="text-center"><?php the_field('events_title'); ?></h1>
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
                        'category_name' => 'события',
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
                            <?php $str= get_the_content();
                                preg_match_all('/src="([^"]+)"/i', $str, $matches);
                                $img_urls = $matches[1]; ?>
                                <?php if($img_urls) { ?>
                                <ul class="gallery">
                                <? foreach ($img_urls as $img_url) {?>
                                <li><a href="<?php echo $img_url; ?>" rel="prettyPhoto[cat-<?php echo $post->ID; ?>]" title="<?php the_title(); ?>"><img src="<?php echo $img_url; ?>" alt="" /></a></li>
                                <?php }} ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php }; wp_reset_postdata();?>
                    
                    <!-- <li class="timeline-lastchild">
                    </li> -->
                    
                    <?php
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
                    
                    
                    
                    <!-- <li>
                        <div class="timeline-image">
                                <i class="im im-angle-down"></i>
                        </div>
                    </li> -->
                </ul>
                <div class="d-flex justify-content-center">
                <div class="timeline-image-lastchild">
                    ДАЛЕЕ
                </div>
                    </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-grow" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <!-- <div class="timeline-image-lastchild text-center">
                    ДАЛЕЕ<i class="im im-angle-down" style="color: #AF2B2B; display:inline"></i>
                </div> -->
            </div>
        </div>
    </section>

    


    <section id="gallery" class="container-fluid mt-5 gallery target-section">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center"><?php the_field('gallery_title'); ?></h1>
            </div>
            <div class="row justify-content-center mb-5">
                <h3 class="text-center section-descr"><?php the_field('gallery_description'); ?></h3>
            </div>
            <?php echo do_shortcode('[foogallery id="231"]'); ?>
        </div>            
            
    </section>


    <section id="schedule" class="schedule vh-100 pt-5 mt-5 target-section parallax-window" data-parallax="scroll" data-image-src="<?php the_field('schedule_image'); ?>">
            <div class="container schedule-custom-height-one">
                <div class="row justify-content-center">
                    <h1 class="text-center schedule-section-title"><?php the_field('schedule_title'); ?></h1>
                </div>
                <div class="row justify-content-center mt-3">
                    <h3 class="text-center schedule-section-descr"><?php the_field('schedule_description'); ?></h3>
                </div>
            </div>
            <div class="container h-25">
                <div class="row justify-content-center mt-3">
                    <h3 class="text-center schedule-change">ВЫБЕРИТЕ ВОЗРАСТНУЮ ГРУППУ</h3>
                </div>
            </div>
            <div class="container-fluid h-50" style="color: white; font-size: 48px;">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center"><?php echo get_field('juveniles')['monday']['from']; ?></div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center"><?php echo get_field('juveniles')['monday']['to']; ?></div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center">18:00</div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center">19:00</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center">18:00</div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center">19:00</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center">18:00</div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center">19:00</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center">18:00</div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center">19:00</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center">18:00</div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center">19:00</div>
                        </div>
                    </div><div class="col-lg-12 col-xl align-self-center">
                        <div class="row text-center">
                            <div class="col-3 col-xl-12">ПН</div>
                            <div class="col-4 col-xl-12 mt-xl-5 text-right text-xl-center">18:00</div>
                            <div class="col-1 col-xl-12">-</div>
                            <div class="col-4 col-xl-12 text-left text-xl-center">19:00</div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section id="contacts" class="container-fluid contacts target-section">
        <div class="row pt-5">
            <div class="col" id="request" >
                <div class="row justify-content-center">
                    <h1 class="text-center">ЗАПИСЬ НА ЗАНЯТИЯ</h1>
                </div>
                <form class=" mt-5">
                    <fieldset class="mx-auto">
                        <!-- <?php do_shortcode('[contact-form-7 id="75" title="Контактная форма"]'); ?> -->
                        
                        <div class="form-field row">
                            <input name="contactName" type="text" id="contactName" placeholder="Имя" minlength="2" required="" aria-required="true" class="form-input w-100">
                        </div>
                        <div class="form-field row mt-3">
                            <input name="contactSurname" type="text" id="contactSurname" placeholder="Фамилия" minlength="2" required="" aria-required="true" class="form-input w-100">
                        </div>
                        <div class="form-field row">
                            <div class="col-11 pl-0 align-self-end">
                                <input name="contactAge" type="text" id="contactAge" placeholder="Укажите Ваш возраст" minlength="1" required="" aria-required="true" class="form-input w-100">
                            </div>
                            <div class="col-1 w-100">
                                <div class="row">
                                    <div class="col-12">
                                        <i class="im im-angle-up icon-count icon-add"></i>
                                    </div>
                                    <div class="col-12">
                                        <i class="im im-angle-down icon-count"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-field row mt-3">
                            <div class="col-11 pl-0">
                                <input name="contactEmail" type="email" id="contactEmail" placeholder="Почта" minlength="2" required="" aria-required="true" class="form-input w-100">
                            </div>
                            <div class="col-1">
                                <ion-icon name="refresh" class="icon-short"></ion-icon>
                            </div>
                        </div>
                        <div class="form-field row mt-3">
                            <textarea name="contactMassage" rows="5" cols="30" wrap="soft" placeholder="Дополнительные данные, которые Вы бы хотели указать" class="w-100"></textarea>
                        </div>
                        <div class="form-field row mt-3">
                            <input name="contactEmail" type="submit" id="contactEmail" value="ОТПРАВИТЬ" class="form-input w-100">
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col" id="contacts">
                <div class="row justify-content-center">
                    <h1 class="text-center">КОНТАКТЫ</h1>
                </div>
                <div class="container d-flex justify-content-center" style="height: -webkit-fill-available">
                    <div class="row align-self-center w-75">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h3>телефон</h3>
                                </div>
                                <div class="col">
                                    <h4>8(888)888-88-88</h4>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <h3>почта</h3>
                                </div>
                                <div class="col">
                                    <h4>mail@mail.ru</h4>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <h3>адрес</h3>
                                </div>
                                <div class="col">
                                    <h4>г. Орел, ул. Орел, д. 1</h4>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                        <i class="im im-vk"></i>
                                </div>
                                <div class="col">
                                        <i class="im im-vk"></i>
                                </div>
                                <div class="col">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M17.492 15.432c-.433 0-.855-.087-1.253-.259l.467-1.082c.25.107.514.162.786.162.222 0 .441-.037.651-.11l.388 1.112c-.334.118-.683.177-1.039.177zm-10.922-.022c-.373 0-.741-.066-1.093-.195l.407-1.105c.221.081.451.122.686.122.26 0 .514-.05.754-.148l.447 1.09c-.382.157-.786.236-1.201.236zm8.67-.783l-1.659-.945.583-1.024 1.66.945-.584 1.024zm-6.455-.02l-.605-1.011 1.639-.981.605 1.011-1.639.981zm3.918-1.408c-.243-.101-.5-.153-.764-.153-.23 0-.457.04-.674.119l-.401-1.108c.346-.125.708-.188 1.075-.188.42 0 .83.082 1.217.244l-.453 1.086zm7.327-.163c-.534 0-.968.433-.968.968 0 .535.434.968.968.968.535 0 .969-.434.969-.968 0-.535-.434-.968-.969-.968zm-16.061 0c-.535 0-.969.433-.969.968 0 .535.434.968.969.968s.969-.434.969-.968c0-.535-.434-.968-.969-.968zm18.031-.832v6.683l-4 2.479v-4.366h-1v4.141l-4-2.885v-3.256h-2v3.255l-4 2.885v-4.14h-1v4.365l-4-2.479v-13.294l4 2.479v3.929h1v-3.927l4-2.886v4.813h2v-4.813l1.577 1.138c-.339-.701-.577-1.518-.577-2.524l.019-.345-2.019-1.456-5.545 4-6.455-4v18l6.455 4 5.545-4 5.545 4 6.455-4v-11.618l-.039.047c-.831.982-1.614 1.918-1.961 3.775zm2-8.403c0-2.099-1.9-3.801-4-3.801s-4 1.702-4 3.801c0 3.121 3.188 3.451 4 8.199.812-4.748 4-5.078 4-8.199zm-5.5.199c0-.829.672-1.5 1.5-1.5s1.5.671 1.5 1.5-.672 1.5-1.5 1.5-1.5-.671-1.5-1.5zm-.548 8c-.212-.992-.547-1.724-.952-2.334v2.334h.952z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>

<?php get_footer() ?>