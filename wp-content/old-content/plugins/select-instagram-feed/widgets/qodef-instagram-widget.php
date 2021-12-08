<?php
if(!defined('ABSPATH')) exit;

class QodefInstagramWidget extends WP_Widget {

	protected $params;

	public function __construct() {
		parent::__construct(
			'qodef_instagram_widget',
			'Select Instagram Widget',
			array( 'description' => __( 'Display instagram images', 'qode' ) )
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'name' => 'title',
				'type' => 'textfield',
				'title' => 'Title'
			),
			array(
				'name' => 'number_of_photos',
				'type' => 'textfield',
				'title' => 'Number of photos'
			),
			array(
				'name' => 'number_of_cols',
				'type' => 'dropdown',
				'title' => 'Number of columns',
				'options' => array(
					'2' => 'Two',
					'3' => 'Three',
					'4' => 'Four',
					'5' => 'Five',
					'6' => 'Six',
					'9' => 'Nine',
				)
			),
			array(
				'name' => 'transient_time',
				'type' => 'textfield',
				'title' => 'Images Cache Time'
			),
		);
	}
	public function getParams() {
		return $this->params;
	}

	public function widget($args, $instance) {
		extract($instance);

		echo suprema_qodef_get_module_part($args['before_widget']);
		echo suprema_qodef_get_module_part($args['before_title'] . $title . $args['after_title']);

        $transient_time = ! empty( $transient_time ) ? $transient_time : '10800';

        $instagram_api = QodefInstagramApi::getInstance();
        $images_array = $instagram_api->getImages($number_of_photos, array(
			'use_transients' => true,
			'transient_name' => $args['widget_id'],
			'transient_time' => $transient_time
		));

        $number_of_cols = $number_of_cols == '' ? 3 : $number_of_cols;

		if(is_array($images_array) && count($images_array)) { ?>
			<ul class="qodef-instagram-feed clearfix qodef-col-<?php echo suprema_qodef_get_module_part($number_of_cols); ?>">
				<?php
				foreach ($images_array as $image) { ?>
					<li>
						<a href="<?php echo esc_url($instagram_api->getHelper()->getImageLink($image)); ?>" target="_blank">
							<?php echo suprema_qodef_kses_img($instagram_api->getHelper()->getImageHTML($image)); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php }

		echo suprema_qodef_get_module_part($args['after_widget']);
	}

	public function form($instance) {
		foreach ($this->params as $param_array) {
			$param_name = $param_array['name'];
			${$param_name} = isset( $instance[$param_name] ) ? esc_attr( $instance[$param_name] ) : '';
		}

		$instagram_api = QodefInstagramApi::getInstance();

		//user has connected with instagram. Show form
		if($instagram_api->hasUserConnected()) {
			foreach ($this->params as $param) {
				switch($param['type']) {
					case 'textfield':
						?>
						<p>
							<label for="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>"><?php echo
								esc_html($param['title']); ?></label>
							<input class="widefat" id="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>" name="<?php echo esc_attr($this->get_field_name( $param['name'] )); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>" />
						</p>
						<?php
						break;
					case 'dropdown':
						?>
						<p>
							<label for="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>"><?php echo
								esc_html($param['title']); ?></label>
							<?php if(isset($param['options']) && is_array($param['options']) && count($param['options'])) { ?>
								<select class="widefat" name="<?php echo esc_attr($this->get_field_name( $param['name'] )); ?>" id="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>">
									<?php foreach ($param['options'] as $param_option_key => $param_option_val) {
										$option_selected = '';
										if(${$param['name']} == $param_option_key) {
											$option_selected = 'selected';
										}
										?>
										<option <?php echo esc_attr($option_selected); ?> value="<?php echo esc_attr($param_option_key); ?>"><?php echo esc_attr($param_option_val); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</p>

						<?php
						break;
				}
			}
		}
	}
}

function qodef_instagram_widget_load(){
	register_widget('QodefInstagramWidget');
}

add_action('widgets_init', 'qodef_instagram_widget_load');