<?php
/**
 * This is the shortcode files.
 * 
 * This file is used to define the shortcodes.
 */

defined('ABSPATH') || exit();

/**
 * Add to calender shortcode.
 * 
 * @param array $attrs Attributes.
 * 
 * @return string | object
 */
function create_shortcode_for_add_to_calender( $attrs ) {

    ob_start();
    ?>
    <add-to-calendar-button 
  name="Custom New Event"
  description="Play with me!"
  startDate="2025-03-15"
  startTime="10:15"
  endTime="17:45"
  timeZone="Asia/Dhaka"
  location="World Wide Web"
  options="'Apple','Google','iCal','Outlook.com','Yahoo'"
></add-to-calendar-button>
    <?php

    return ob_get_clean();
}   
add_shortcode('add_to_calender', 'create_shortcode_for_add_to_calender' );