<?php
/*
Plugin Name: State of employment
Plugin URI: http://wordpress.org/extend/plugins/#
Description: Assign your state of employment. 
Author: Daan De Vry
Version: 1.0
Author URI: http://example.com/
*/

// register My_Widget
add_action( 'widgets_init', function(){
	register_widget( 'SOE_Widget' );
});

class SOE_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'soe_widget',
            'description' => 'Assign your state of employment.',
        );
        parent::__construct( 'soe_widget', 'State Of Employment', $widget_ops );
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_attr_e( 'Current state of employment:', 'text_domain' ); ?>
        </label> 

        <input 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
            type="text" 
            value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    } 
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
    
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo "Current state of employment" . $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo $args['after_widget'];
    }
}