<?php

class vtVcTab extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_custom_mapping' ) );
        add_shortcode( 'vt_vc_tab', array( $this, 'vc_custom_html' ) );
    }
     
    public function vc_custom_mapping() {
         
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        vc_map( 
            array(
                'name' => __('Content Tab', 'Selise Site'),
                'base' => 'vt_vc_tab',
                'description' => __('Content Tab Goes Here', 'Selise Site'), 
                'category' => __('Visual Composer elements', 'Selise Site'),   
                'icon' => '',            
                'params' => array( 
                    array(
                          "type" => "param_group",
                          "holder" => "",
                          "class" => "",
                          "heading" => esc_html__( "Tabs", "Selise Site" ),
                          "param_name" => "_vt_vc_tab_items",
                          "value" => esc_html__( "", "Selise Site" ),
                          "description" => esc_html__( "", "Selise Site" ),
                          'group' => 'General',
                          "params" => array(
                                array(
                                    'type' => 'attach_image',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Featured Image for Chart', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_item_featured_image_chart',
                                    'description' => __( 'Featured Image For Chart', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'attach_image',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Featured Image', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_item_featured_image',
                                    'description' => __( 'Featured Image', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'attach_image',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Featured Image For Active', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_item_featured_image_active',
                                    'description' => __( 'Featured Image for active', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'attach_image',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Featured Image For accordion ', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_item_featured_image_accordion',
                                    'description' => __( 'Featured Image For accordion', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'textfield',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Title', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_item_title',
                                    'description' => __( 'Title', 'Selise Site' ),
                                ),

                                 array(
                                    'type' => 'textfield',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Content Title', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_content_title',
                                    'description' => __( 'Content Title', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'textarea',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Content Description', 'Selise Site' ),
                                    'param_name' => '_vt_vc_tab_content_description',
                                    'description' => __( 'Content Description', 'Selise Site' ),
                                ),


                          ),
                    ),

                    array(
                        'type' => 'textfield',
                        'holder' => '',
                        'class' => '',
                        'heading' => __( 'CSS Class', 'Selise Site' ),
                        'param_name' => '_vt_vc_tab_class',
                        'description' => __( 'CSS Class', 'Selise Site' ),
                        'group' => 'General',
                    ),
                ),
            )
        );                                
        
    }
     
     
    public function vc_custom_html( $atts ) {
         
        extract(
            shortcode_atts(
                array(
                    '_vt_vc_tab_items'   => '',
                    '_vt_vc_tab_class'   => '',
                ), 
                $atts
            )
        );

        $_vt_vc_tab_items = vc_param_group_parse_atts($_vt_vc_tab_items);

       $markup = '';
        $markup.= '<div class ="vc_tab tabs-visible">';
            $markup.= '<ul class="nav nav-tabs" role="tablist">';
            $item_flag = 0;
            foreach ($_vt_vc_tab_items as $item) {

                $item_featured_image = wp_get_attachment_image_src($item['_vt_vc_tab_item_featured_image'],'thumbnail')[0];
                $item_featured_image_active = wp_get_attachment_image_src($item['_vt_vc_tab_item_featured_image_active'],'thumbnail')[0];
                $class = '';

                if($item_flag == 0){
                    $class = 'active';
                }

                if(!empty($item_featured_image && $item_featured_image_active)) { 

                $markup.= '<li role="presentation" class="'.$class.'"><a href="#'.str_replace(' ','-',$item['_vt_vc_tab_item_title']).'" aria-controls="home" role="tab" data-toggle="tab"><img src="'.$item_featured_image.'" alt="Image" class="img-responsive img-hide"><img src="'.$item_featured_image_active.'" alt="Image" class="img-responsive img-active">'.$item['_vt_vc_tab_item_title'].'</a></li>';
                }

                $item_flag++;
            }
            $markup.= '</ul>';

            $markup.= '<div class="tab-content">';
            $content_flag = 0;
            foreach ($_vt_vc_tab_items as $content) {
                $item_featured_image = wp_get_attachment_image_src($content['_vt_vc_tab_item_featured_image_chart'],'full')[0];
                $content_title = $content['_vt_vc_tab_content_title'];
                $content_description = $content['_vt_vc_tab_content_description'];
                $class = '';
                if($content_flag == 0){
                    $class = 'in active';
                }
                $markup.= '<div role="tabpanel" class="tab-pane fade '.$class.' " id="'.str_replace(' ','-',$content['_vt_vc_tab_item_title']).'">';
                    $markup.= '<div class="container">';
                        $markup.= '<div class="row row-height">';
                            $markup.= '<div class="col-lg-6">';

                            if(!empty($item_featured_image)){  
                                $markup.= '<img src="'.$item_featured_image.'" alt="Image" class="img-responsive">';
                            }
                                
                            $markup.= '</div>';
                            $markup.= '<div class="col-lg-6">';
                                $markup.= '<div class="tab_content">';

                                if(!empty($content_title)){
                                    $markup.= '<h3>';    
                                        $markup.= $content_title;
                                    $markup.= '</h3>';
                                }
                                
                                if(!empty($content_description)){    
                                    $markup.= '<p>';    
                                        $markup.= $content_description;
                                    $markup.= '</p>';    
                                }
                                    
                                $markup.= '</div>';    
                            $markup.= '</div>';
                        $markup.= '</div>';
                    $markup.= '</div>';
                $markup.= '</div>';
                $content_flag++;
            }
            $markup.= '</div>';    
        $markup.= '</div>';



        //Accordion

        $markup.='<div class="panel-group accordion-visible" id="accordion" role="tablist" aria-multiselectable="true">';
            foreach ($_vt_vc_tab_items as $item_accordion) {
                $item_featured_image_accordion = wp_get_attachment_image_src($item_accordion['_vt_vc_tab_item_featured_image_accordion'],'thumbnail')[0];
                $content_title = $item_accordion['_vt_vc_tab_content_title'];
                $content_description = $item_accordion['_vt_vc_tab_content_description'];
                $markup.='<div class="panel panel-header-text">';
                    $markup.='<a role="button" data-toggle="collapse" data-parent="#accordion" href="#'.str_replace(' ','-',$item_accordion['_vt_vc_tab_item_title']).'-accordion" aria-expanded="true" aria-controls="collapseOne">';
                        $markup.='<div class="panel-heading panel-background" role="tab" id="headingOne">';
                            $markup.='<h4 class="panel-title icon">';

                            if(!empty($item_featured_image_accordion)){
                                $markup.= '<img src="'.$item_featured_image_accordion.'" alt="Image" class="img-responsive">'.$item_accordion['_vt_vc_tab_item_title'];
                            }
                                
                            $markup.='</h4>';
                        $markup.='</div>';
                    $markup.='</a>';

                    $markup.='<div id="'.str_replace(' ','-',$item_accordion['_vt_vc_tab_item_title']).'-accordion" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
                        $markup.='<div class="panel-body">';
                        
                         if(!empty($content_title)){
                            $markup.= '<h3>';    
                                $markup.= $content_title;
                            $markup.= '</h3>';
                        }
                        
                        if(!empty($content_description)){    
                            $markup.= '<p>';    
                                $markup.= $content_description;
                            $markup.= '</p>';    
                        }
                            
                        $markup.='</div>';
                    $markup.='</div>';
                $markup.='</div>';
            }
        $markup.='</div>';


    return $markup;
    }
    
     
}

new vtVcTab();