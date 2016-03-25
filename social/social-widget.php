<?php
/**
 * Plugin Name: Social Widget Plugin
 * Plugin URI: http://www.technologyofkevin.com
 * Description: Social small logo
 * Author: Kevin Wei
 * Version: 1.0
 * Author URI: http://www.technologyofkevin.com
 */

 /**
  * Include CSS file for MyPlugin.
  */
function social_widget_scripts() {
  wp_register_style( 'social-widget',  plugin_dir_url( __FILE__ ) . 'css/social-styles.css' );
  wp_enqueue_style( 'social-widget' );
}
add_action( 'wp_enqueue_scripts', 'social_widget_scripts' );

add_action( 'widgets_init', 'social_register_widgets' );

function social_register_widgets() {
	register_widget( 'SocialPostWidget' );
}

/**
 * Social Post Widget
 *
 * @since 1.0
 */

class SocialPostWidget extends WP_Widget {

// init
	function SocialPostWidget() {
		$widget_ops = array( 'classname' => 'SocialPostWidget', 'description' => 'Displays social small logo' );

		parent::__construct( 'Social_Post_Widget', 'Social Post', $widget_ops );
	}

// front-end
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
    $title = $instance['title'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
    $youtube = $instance['youtube'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display name from widget settings if one was input. */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* If show announcement was selected, display the announcement. */
		if ( $facebook || $twitter || $youtube){
      echo '<ul class="member_social_plugin">';
      if ( $facebook ) {echo '<li class="social_plugin_facebook"><a href=' . $facebook . '><div class="social_plugin_ico"><img class="social_plugin_img" src="'.plugin_dir_url( __FILE__ ).'img/facebook_icon.png"></div></a></li>';}
      if ( $twitter ) {echo '<li class="social_plugin_twitter"><a href=' . $twitter . '><div class="social_plugin_ico"><img class="social_plugin_img" src="'.plugin_dir_url( __FILE__ ).'img/twitter_icon.png"></div></a></li>';}
      if ( $youtube ) {echo '<li class="social_plugin_youtube"><a href=' . $youtube . '><div class="social_plugin_ico"><img class="social_plugin_img" src="'.plugin_dir_url( __FILE__ ).'img/youtube_icon.png"></div></a></li>';}
      echo '</ul>';
    }

		/* After widget (defined by themes). */
		echo $after_widget;
	}

// update
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
    $instance['twitter'] = strip_tags( $new_instance['twitter'] );
    $instance['youtube'] = strip_tags( $new_instance['youtube'] );

		return $instance;
	}

// back-end
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'video', 'videourl' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook:</label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" style="width:100%;">
			<pre><?php echo $instance['facebook']; ?></pre>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'witter' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" style="width:100%;">
			<pre><?php echo $instance['twitter']; ?></pre>
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" style="width:100%;">
			<pre><?php echo $instance['twitter']; ?></pre>
		</p>

	<?php
	}
}

?>
