<?php
/*
Plugin Name: Plugin Test
Plugin URI: http://www.aaronweidele.com
Description: Plugin Test!!!!
Version: 1.0
Author: Aaron
Author URI: http://www.aaronweidele.com
*/
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class AW_PluginTest {

  private static $instance = null;
  public $options;
  public $page = 'plugin-test';

  public static function init() {
    if ( null == self::$instance ) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  private function __construct() {
    add_action( 'admin_menu', array( &$this, 'add_page' ) );
    add_action( 'admin_init', array( &$this, 'register_page_options') );
  }


  public function add_page() {
    add_options_page( 'Theme Options', 'Theme Options', 'manage_options', $this->page, array( $this, 'display_page' ) );
  }

  public function display_page() {
    ?>
    <div class="wrap">
        <h2>Theme Options</h2>
        <form method="post" action="options.php">
        <?php
            settings_fields($this->page);
            do_settings_sections($this->page);
            submit_button();
        ?>
        </form>
    </div> <!-- /wrap -->

    <?php
  }

  public function register_page_options() {

    // Add Section for option fields
    add_settings_section( 'pltest_section', 'Theme Options', array( $this, 'display_section' ), $this->page ); // id, title, display cb, page

    // Add Title Field
    add_settings_field( 'pltest_title_field', 'Blog Title', array( $this, 'title_settings_field' ), $this->page, 'pltest_section' ); // id, title, display cb, page, section

    // Add Background Color Field
    add_settings_field( 'pltest_bg_field', 'Background Color', array( $this, 'bg_settings_field' ), $this->page, 'pltest_section' ); // id, title, display cb, page, section

    // Register Settings
    register_setting( $this->page, 'pltest_settings_options', array( $this, 'validate_options' ) ); // option group, option name, sanitize cb
  }

  public function title_settings_field() {

    $val = ( isset( $this->options['title'] ) ) ? $this->options['title'] : '';
    echo '<input type="text" name="cpa_settings_options[title]" value="' . $val . '" />';
  }

  public function bg_settings_field() {

    $val = ( isset( $this->options['title'] ) ) ? $this->options['background'] : '';
    echo '<input type="text" name="cpa_settings_options[background]" value="' . $val . '" class="cpa-color-picker" >';

  }

}

AW_PluginTest::init();
//$aw_plugintest = new AW_PluginTest;
