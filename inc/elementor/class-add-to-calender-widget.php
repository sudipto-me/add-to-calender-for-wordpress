<?php

class DWM_Add_To_Calendar_Widget extends \Elementor\Widget_Base{
    public function get_name(): string {
		return 'dwm_add_to_calender';
	}

	public function get_title(): string {
		return esc_html__( 'Add to Calendar', 'dew-wealth-add-to-calender' );
	}

	public function get_icon(): string {
		return 'eicon-calendar';
	}

	public function get_categories(): array {
		return [ 'basic' ];
	}

	public function get_keywords(): array {
		return [ 'dew', 'calendar' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Event Details', 'dew-wealth-add-to-calender'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __('Event Name', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Sample Event', 'dew-wealth-add-to-calender'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Event Description', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Play with me!', 'dew-wealth-add-to-calender'),
            ]
        );

        $this->add_control(
            'start_date',
            [
                'label' => __('Start Date', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => array(
                    'enableTime' => false
                ), 
                'default' => date('Y-m-d'),
            ]
        );

        $this->add_control(
            'start_time',
            [
                'label' => __('Start Time', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '10:15',
            ]
        );

         $this->add_control(
            'end_date',
            [
                'label' => __('End Date', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                 'picker_options' => array(
                    'enableTime' => false
                ), 
                'default' => date('Y-m-d'),
            ]
        );

        $this->add_control(
            'end_time',
            [
                'label' => __('End Time', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '17:45',
            ]
        );

        $this->add_control(
            'time_zone',
            [
                'label' => __('Time Zone', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'US/Mountain',
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => __('Location', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('World Wide Web', 'dew-wealth-add-to-calender'),
            ]
        );

        $this->add_control(
            'availability',
            [
                'label' => __('Availability', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
               'options' => [
					'free' => __('Free', 'dew-wealth-add-to-calender'),
                    'busy' => __('Busy', 'dew-wealth-add-to-calender'),
				],
            ]
        );

        $this->add_control(
            'organizer_name',
            [
                'label' => __('Organizer Name', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'organizer_email',
            [
                'label' => __('Organizer Email','dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
            );
        
        $this->add_control(
            'ics_file_link',
            [
                'label' => __('Existing ICS File Link', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::URL
                ]
        );

        $this->add_control(
            'ics_file_name',
            [
                'label' => __('ICS File Name', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Event to Save'
                ]
        );


        $this->add_control(
			'options',
			[
				'label' => esc_html__( 'Calendar Options', 'dew-wealth-add-to-calenderomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'Apple' => __('Apple', 'dew-wealth-add-to-calender'),
                    'Google' => __('Google', 'dew-wealth-add-to-calender'),
                    'iCal' => __('ICS File', 'dew-wealth-add-to-calender'),
                    'Outlook.com' => __('Outlook.com', 'dew-wealth-add-to-calender'),
                    'Yahoo' => __('Yahoo', 'dew-wealth-add-to-calender'),
				],
				 'default' => ['Google', 'Outlook.com'],
			]
		);

        $this->add_control(
			'past_date_handle',
			[
				'label' => esc_html__( 'Past date handle', 'dew-wealth-add-to-calender' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'none' => __('No past date handle', 'dew-wealth-add-to-calender'),
                    'disable' => __('Disable event', 'dew-wealth-add-to-calender'),
                    'hide' => __('Hide event', 'dew-wealth-add-to-calender'),
				],
				 'default' => ['none'],
			]
		);

        $this->add_control(
            'label',
            [
                'label' => __('Button Name', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Add to Calendar', 'dew-wealth-add-to-calender'),
            ]
        );
       
        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style Options', 'dew-wealth-add-to-calender'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_type',
            [
                'label' => __('List Type', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'dropdown' => __('Dropdown', 'dew-wealth-add-to-calender'),
                    'dropdown-static' => __('Dropdown Static', 'dew-wealth-add-to-calender'),
                    'dropup-static' => __('Dropup Static', 'dew-wealth-add-to-calender'),
                    'modal' => __('Modal', 'dew-wealth-add-to-calender'),
                    'overlay' => __('Overlay', 'dew-wealth-add-to-calender'),
                ],
                'default' => 'dropdown',
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => __('Button Style', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => __('Default', 'dew-wealth-add-to-calender'),
                     '3d' => __('3d', 'dew-wealth-add-to-calender'),
                     'flat' => __('Flat', 'dew-wealth-add-to-calender'),
                    'round' => __('Round', 'dew-wealth-add-to-calender'),
                    'neumorphism' => __('Neumorphism', 'dew-wealth-add-to-calender'),
                    'text' => __('Text', 'dew-wealth-add-to-calender'),
                    'date' => __('Date', 'dew-wealth-add-to-calender'),
                ],
                'default' => 'default',
            ]
        );

         
        $this->add_control(
            'show_button_as_list',
            [
                'label' => __('Show Button As List', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
			'hide_icons',
			[
				'label' => esc_html__( 'Hide Calendar Icons', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'hideIconButton' => __('Button Icons', 'dew-wealth-add-to-calender'),
                    'hideIconList' => __('List Icons', 'dew-wealth-add-to-calender'),
                    'hideIconModal' => __('Modal Icons', 'dew-wealth-add-to-calender'),
				]
			]
		);

        $this->add_control(
			'hide_texts',
			[
				'label' => esc_html__( 'Hide Calendar Texts', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'hideTextLabelButton' => __('Button Text', 'dew-wealth-add-to-calender'),
                    'hideTextLabelList' => __('List Text', 'dew-wealth-add-to-calender'),
				]
			]
		);

        $this->add_control(
            'show_checkmark',
            [
                'label' => __('Show Checkmark', 'dew-wealth-add-to-calender'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->end_controls_section();


    }


	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$options = !empty($settings['options']) ? "'" . implode("','", $settings['options']) . "'" : '';
         // Ensure end date is not before start date
        if (strtotime($settings['end_date']) < strtotime($settings['start_date'])) {
            $settings['end_date'] = $settings['start_date'];
        }

        $start_date = date('Y-m-d', strtotime($settings['start_date']));
        $end_date = date('Y-m-d', strtotime($settings['end_date']));

        $hide_icons = !empty($settings['hide_icons']) ? implode(" ", $settings['hide_icons']) : '';
        $hide_texts = !empty($settings['hide_texts']) ? implode(" ", $settings['hide_texts']) : '';
         ?>
          <add-to-calendar-button 
            name="<?php echo esc_attr($settings['name']);?>"
            description="<?php echo esc_attr($settings['description']);?>"
            startDate="<?php echo esc_attr($start_date);?>"
            startTime="<?php echo esc_attr($settings['start_time']);?>"
            endDate="<?php echo esc_attr($end_date);?>"
            endTime="<?php echo esc_attr($settings['end_time']);?>"
            timeZone="<?php echo esc_attr($settings['time_zone']);?>"
            location="<?php echo esc_attr($settings['location']);?>"
            <?php if( !empty($settings['organizer_name']) && !empty($settings['organizer_email'])):?>
                <?php if( is_email($settings['organizer_email'])):?>
                    organizer="<?php echo $settings['organizer_name'];?>|<?php echo $settings['organizer_email'];?>"
                <?php endif;?>
            <?php endif;?>
            <?php if( isset($settings['ics_file_link']) && !empty($settings['ics_file_link']['url'])): ?>
                icsFile="<?php echo esc_url( $settings['ics_file_link']['url']);?>"
            <?php endif;?>    
            <?php if( !empty($settings['availability'])):?>
                availability="<?php echo $settings['availability'];?>"
            <?php endif;?>
            <?php if( !empty($settings['ics_file_name'])):?>
                iCalFileName="<?php echo $settings['ics_file_name'];?>"
            <?php endif;?> 
            options="<?php echo $options;?>"
            listStyle="<?php echo $settings['list_type'];?>"
            buttonStyle="<?php echo $settings['button_style'];?>"
            <?php if( !empty($hide_icons)):?>
                <?php echo $hide_icons;?>
            <?php endif;?>
            <?php if( !empty($hide_texts)):?>
                <?php echo $hide_texts;?>
            <?php endif;?>    
            <?php if('yes' == $settings['show_button_as_list']):?>
            buttonsList
            <?php endif;?>   
            pastDateHandling="<?php echo implode("",$settings['past_date_handle']);?>" 

            <?php if('yes' != $settings['show_checkmark']):?>
                hideCheckmark
            <?php endif;?>
            label = "<?php echo esc_attr($settings['label']);?>"
            ></add-to-calendar-button>

            <script>
        document.addEventListener("DOMContentLoaded", function () {
            const atcbElement = document.querySelector("add-to-calendar-button");

            if (atcbElement) {
                setTimeout(() => {
                    if (atcbElement.shadowRoot) {
                        const style = document.createElement("style");
                        style.textContent = `
                            :host #atcb-reference {
                                display:none;
                            }
                        `;
                        atcbElement.shadowRoot.appendChild(style);
                    }
                }, 1000);
            }
        });
</script>
                        <?php
	}
}