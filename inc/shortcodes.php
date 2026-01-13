<?php
defined('ABSPATH') || exit();



/**
 * Add to calender shortcode.
 * 
 * @param array $attrs Attributes.
 * 
 * @return string | object
 */
function add_to_calender_shortcode_callback( $attrs ) {

    ob_start();
    ?>
    <add-to-calendar-button 
  name="DW New Event"
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
add_shortcode('dw_add_to_calender', 'add_to_calender_shortcode_callback' );