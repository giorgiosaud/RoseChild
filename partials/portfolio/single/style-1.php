<section class="portfolio portfolio-style-tree" id="portfolio">
    <div class="portfolio-project-container container">
        <div class="portfolio-project-media col-md-9">
            <?php $gallery = rose_get_meta( get_the_ID(), 'gallery'); if( ! empty( $gallery  ) ):
            $i = 0;
            foreach( $gallery as $image ):
                if( $i !== 0 ):?>
            <div class="spacer"></div>
            <?php
            endif;
            $array=explode('.',$image);            
            $ext=array_pop($array);
            $extimagenes=['jpg','jpeg','gif','png','svg'];
            $extvideo=['webm','mp4'];
            if(in_array($ext,$extimagenes)){
                ?>
                <img src="<?php echo esc_url( $image );?>" alt="<?php esc_html_e('Project Media','rose');?>" class="scale">           
                <?php
            }
            elseif(in_array($ext,$extvideo)){
                ?>
                <video class="scale video-js" data-setup='{"controls": false, "autoplay": true, "preload": "auto","loop":true}'>
                    <source src ="<?php echo esc_url( $image );?>" alt="<?php esc_html_e('Project Media','rose');?>" />
                    </video>
                    <?php
                }
                else{
                    echo $ext;
                }


                ?>

                <?php $i++; endforeach;
                $embeds=rose_get_meta( get_the_ID(), 'embeds_group');
                // var_dump($embeds);
                if($embeds){
                    foreach ( (array) $embeds as $key => $embed ) {
                        
                        ?>
                        <div class="spacer"></div>
                        <div class="responsive-iframe">
                            <?php
                            echo wp_oembed_get( $embed['rose_oembed']);
                            ?>
                        </div>
                        <?php
                    }
                }

                ?>
                
            </div>
        <?php endif;?>
        <div class="portfolio-project-details col-md-3">
            <div class="ui-excerpt">

                <?php the_excerpt();?>
            </div>
            <!-- Project info details -->
            <ul>
                <?php $client = rose_get_meta( get_the_ID(), 'client') ; if( ! empty($client )):?>
                <li>
                    <span><?php esc_html_e('Client :','rose');?></span><?php echo esc_attr( $client );?>
                </li>
            <?php endif;?>
            <?php if( has_term('', 'portfolio_type', get_the_ID()) ):?>
                <li>
                    <span><?php esc_html_e('Category : ','rose');?></span>
                    <ul>
                        <?php the_terms( get_the_ID(), 'portfolio_type', '<li>', '</li><li>', '</li>');?>
                    </ul>
                </li>
            <?php endif;?>
            <?php $executive = rose_get_meta( get_the_ID(), 'executive'); if( ! empty( $executive  ) ):?>
            <li>
                <span><?php esc_html_e('Executive : ','rose');?></span><?php echo esc_attr( $executive );?>
            </li>
        <?php endif;?>
        <?php $url = rose_get_meta( get_the_ID(), 'url' ); if( ! empty( $url  )):?>
        <li>
            <span><?php esc_html_e('Project url : ','rose');?></span><a href="<?php echo esc_url($url);?>"><?php echo esc_attr($url);?></a>
        </li>
    <?php endif;?>
    <?php $date = rose_get_meta( get_the_ID(), 'date' ); if( ! empty( $date )):?>
    <li>
        <span><?php esc_html_e('Date realised : ','rose');?></span><?php echo esc_attr($date);?>
    </li>
<?php endif;?>
</ul>
<?php $content = get_the_content(); if( ! empty( $content ) ):?>
    <div class="clearfix portfolio-content">
        <?php the_content(); ?>
    </div>
<?php endif;?>
</div><!-- PROJECT DETAILS -->
<div class="col-md-12">
    <?php 
    $related_posts_title = rose_get_meta( get_the_ID(), 'related_portfolios_title'); 
    if( empty( $related_posts_title  ) ){
        $related_posts_title='';
    }
    $related_posts_sub_title = rose_get_meta( get_the_ID(), 'related_portfolios_sub_title'); 
    if( empty( $related_posts_sub_title  ) ){
        $related_posts_sub_title='';
    }
    $related_posts = rose_get_meta( get_the_ID(), 'related_portfolios'); if( ! empty( $related_posts  ) ):
    $commaRP=implode(', ', $related_posts);
    $text="[vc_row full_width='stretch_row' el_id='related' el_class='portfolio portfolio-style-two section-area no-pd-b'][vc_column][qk_title title='$related_posts_title' sub_title='$related_posts_sub_title'  tpl='' type_heading='' no_title='' title1='' font_style1='' no_line='' color_line1='' pos_line='' margin_line='' font_icon=''][qk_portfolio_by_id style='gutters' el_align='text-center' columns='4'  posts_per_page='4' ids='$commaRP' orderby='date' order='DESC'][/vc_column][/vc_row]";
    echo do_shortcode($text);
    endif;
    echo do_shortcode('[fbcomments url="" width="100%" count="on" title="Comentarios" num="10" scheme="light" countmsg="Maravillosos Comentarios!"]'); ?>
</div>
</div>
</section>

<!-- *********************
    LINK SECTION
    ********************** -->
    <?php $link = rose_get_meta( get_the_ID(), 'link' ); if( ! empty( $link ) ):?>
    <section class="ui-link-section">
        <div class="container">
            <div class="m-link-section default-bg">
                <a href="<?php echo esc_url( $link );?>"></a>
                <h3 class="m-link-section-title">
                    <?php esc_html_e('Let\'s Talk About Your Project','rose');?>
                </h3>
            </div>
        </div>
    </section>
<?php endif;?>
<!-- *********************-->