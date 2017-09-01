<?php
/*
 *	Switch Param
 */

if ( ! class_exists( 'BBC_Toggle' ) ) {
	class BBC_Toggle {
		function __construct() {
			add_action( 'fl_builder_control_bbc-toggle', array( $this, 'bbc_toggle' ), 1, 4 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		function enqueue_scripts() {
			if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
				wp_enqueue_style( 'bbc-toggle', plugins_url( 'css/bbc-toggle.css', __FILE__ ) );
				wp_enqueue_script( 'bbc-toggle', plugins_url( 'js/bbc-toggle.js', __FILE__ ), array( 'jquery' ), '', true );
			}
		}

		function bbc_toggle( $name, $value, $field ) {
			$option_counter = 1;
			$toggle_options = array();
			$bbc_preview   = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );
			$bbc_toggle    = isset( $field['toggle'] ) ? " data-toggle='" . json_encode( $field['toggle'] ) . "'" : '';
			$label_width    = isset( $field['width'] ) ? $field['width'] : '';

			if ( array_key_exists( 'options', $field ) ) {

				$options = $field['options'];

				foreach ( $options as $t_key => $t_value ) {
					$toggle_options[ $t_key ] = $t_value;
				}
			} else {
				$toggle_options['yes'] = 'Yes';
				$toggle_options['no']  = 'No';
			}

			$output = "<div class='bbc-toggle fl-field' data-type='select' data-preview='" . $bbc_preview . "'>";

			/* Dynamic Style */
			$output .= '<style>';
			$output .= '.bbc-toggle .' . $name . '{';
			$output .= 'background: #f7f7f7;';
			$output .= 'border-color: #ccc;';
			$output .= '}';

			$output .= '.bbc-toggle .' . $name . ':checked + .' . $name . '{';
			$output .= 'background: #1e8cbe;';
			$output .= 'background: #2ea2cc;';
			$output .= 'border-color: #0074a2;';
			$output .= 'color: #fff;';
			$output .= '}';
			if ( $label_width != '' ) {
				$output .= '.bbc-toggle-label.' . $name . '{';
				$output .= 'width: ' . $label_width . ';';
				$output .= '}';
			}
			$output .= '</style>';

			foreach ( $toggle_options as $t_key => $t_value ) {
				$t_pos = 'bbc-toggle-' . $option_counter;

				$output .= $this->get_input_field( $name, $value, $t_key, $t_value, $t_pos );

				$option_counter = $option_counter + 1;

			}

			$output .= '<select class="bbc-toggle-select bbc-switch-' . $name . '" style="display:none;" name="' . $name . '"' . $bbc_toggle . '>';

			foreach ( $options as $t_key => $t_value ) {

				$selected = '';
				if ( $value == $t_key ) {
					$selected = ' selected="selected"';
				}
				$output .= '<option value="' . $t_key . '" ' . $selected . '>' . $t_value . '</option>';
			}
			$output .= '</select>';

			$output .= '</div>';

			echo $output;
		}

		function get_input_field( $name, $value, $option_key, $option_value, $pos ) {
			$checked = '';
			if ( $value == $option_key ) {
				$checked = 'checked';
			}
			$html = '<input type="radio" class="bbc-toggle-radio ' . $name . '" id="' . $name . '_' . $pos . '" name="' . $name . '" value="' . $option_key . '" ' . $checked . '/>';
			$html .= '<label class="bbc-toggle-label ' . $name . '" for="' . $name . '_' . $pos . '">' . $option_value . '</label>';

			return $html;
		}
	}

	new BBC_Toggle();
}
