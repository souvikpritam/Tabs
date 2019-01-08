<?php

class vcTimelineComponent extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_timeline_mapping' ) );
        add_shortcode( 'vc_timeline', array( $this, 'vc_timeline_html' ) );
    }
     
     public function vc_timeline_mapping() {
         
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        vc_map( 
            array(
                'name' => __('Timeline Component', 'Selise Site'),
                'base' => 'vc_timeline',
                'description' => __('Timeline Component Goes Here', 'Selise Site'), 
                'category' => __('Visual Composer elements', 'Selise Site'),   
                'icon' => '',            
                'params' => array( 
                    array(
                          "type" => "param_group",
                          "holder" => "",
                          "class" => "",
                          "heading" => esc_html__( "Content timeline", "Selise Site" ),
                          "param_name" => "_vc_timeline_items",
                          "value" => esc_html__( "", "Selise Site" ),
                          "description" => esc_html__( "", "Selise Site" ),
                          'group' => 'General',
                          "params" => array(
                                array(
                                    'type' => 'textfield',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Date', 'Selise Site' ),
                                    'param_name' => '_vc_date',
                                    'description' => __( 'Date', 'Selise Site' ),
                                ),
                                 array(
                                    'type' => 'attach_image',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Featured Image', 'Selise Site' ),
                                    'param_name' => '_vc_timeline_featured_image',
                                    'description' => __( 'Featured Image', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'textfield',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Title', 'Selise Site' ),
                                    'param_name' => '_vc_timeline_title',
                                    'description' => __( 'Title', 'Selise Site' ),
                                ),

                                array(
                                    'type' => 'textarea',
                                    'holder' => '',
                                    'class' => '',
                                    'heading' => __( 'Content Description', 'Selise Site' ),
                                    'param_name' => '_vc_timeline_description',
                                    'description' => __( 'Content Description', 'Selise Site' ),
                               ),
                          ),
                    ),

                    array(
                        'type' => 'textfield',
                        'holder' => '',
                        'class' => '',
                        'heading' => __( 'CSS Class', 'Selise Site' ),
                        'param_name' => '_vc_timeline_class',
                        'description' => __( 'CSS Class', 'Selise Site' ),
                        'group' => 'General',
                    ),
                ),
            )
        );                                
        
    }
     
     
    public function vc_timeline_html( $atts ) {
         
        extract(
            shortcode_atts(
                array(
                    '_vc_timeline_items'   => '',
                    '_vc_timeline_class'   => '',
                ), 
                $atts
            )
        );

        $_vc_timeline_items = vc_param_group_parse_atts($_vc_timeline_items);

       $markup = '';
       
       $markup .='<div class="vc_timeline_wrapper">';
	       $markup .='<div class="blog_wrapper isotope_wrapper">';
		       $markup .='<div class="posts_group lm_wrapper timeline">';
			       
		       	foreach ($_vc_timeline_items as $timeline_items) {
		       		$timeline_date = $timeline_items['_vc_date'];
        			$timeline_img = wp_get_attachment_image_src($timeline_items['_vc_timeline_featured_image'],'full')[0];
        			$timeline_title = $timeline_items['_vc_timeline_title'];
        			$timeline_description = $timeline_items['_vc_timeline_description'];

			       $markup .='<div class="post-item isotope-item clearfix post type-post">';
			        if(!empty($timeline_date)) {
				        $markup .='<div class="date_label">';
				       		$markup .= $timeline_date;
				        $markup .='</div>';
				    }  
				        if(!empty($timeline_img)) {
					       $markup .='<div class="image_frame post-photo-wrapper scale-with-grid">';
					       		$markup .='<div class="image_wrapper">';
					       			$markup .='<div class="mask"></div>';
					       				$markup.= '<img src="'.$timeline_img.'" alt="Image" class="img-responsive">';	
					       		$markup .='</div>';
					    	$markup .='</div>';
					    }
					       $markup .='<div class="post-desc-wrapper">';
					       		$markup .='<div class="post-desc">';
					       		if(!empty($timeline_title)) {
					       			$markup .='<div class="post-title">';
					       				$markup .='<h2 class="entry-title" itemprop="headline">';
					       					$markup .= $timeline_title;
					       				$markup .='</h2>';
					       			$markup .='</div>';
					       		}
					       		if(!empty($timeline_description)) {
					       			$markup .='<div class="post-excerpt">';
					       		 		$markup .='<p>';
					       		 			$markup .= nl2br($timeline_description);
					       		 		$markup .='</p>';
					       			$markup .='</div>';
					       		}
					       $markup .='</div>';
				       $markup .='</div>';
			       $markup .='</div>';

			       }

		       $markup .='</div>';
	       $markup .='</div>';
       $markup .='</div>';

    return $markup;

    }      
}

new vcTimelineComponent();