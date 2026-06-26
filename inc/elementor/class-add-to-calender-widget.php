<?php
/**
 * This is the file for elementor widgets.
 */

defined('ABSPATH') || exit();
class Add_to_Calender_Widget extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     */
    public function get_name() {
		return 'add_to_calender';
	}

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     */
	public function get_title() {
		return esc_html__( 'Add to Calendar', 'add-to-calender' );
	}

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     */
	public function get_icon() {
		return 'eicon-calendar';
	}

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     * @since 1.0.0
     */
	public function get_categories() {
		return [ 'basic' ];
	}

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     * @since 1.0.0
     */
	public function get_keywords() {
		return [ 'add-to-calender', 'calendar' ];
	}

    /**
     * Register widget controls.
     *
     * @return void
     * @since 1.0.0
     */
	protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Event Details', 'add-to-calender'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __('Event Name', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Sample Event', 'add-to-calender'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Event Description', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Play with me!', 'add-to-calender'),
            ]
        );

        
        $this->add_control(
            'start_date',
            [
                'label' => __('Start Date', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => array(
                    'enableTime' => false
                ), 
                'default' => date('Y-m-d'),
                
            ]
        );

        

        $this->add_control(
            'all_day_event',
            [
                'label' => __('All Day Event', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'add-to-calender' ),
                'label_off' => esc_html__( 'No', 'add-to-calender' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'start_time',
            [
                'label' => __('Start Time', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '10:15',
                'condition' => [
                    'all_day_event!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'end_date',
            [
                'label' => __('End Date', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                 'picker_options' => array(
                    'enableTime' => false
                ), 
                'default' => date('Y-m-d'),
                'condition' => [
                    'all_day_event!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'end_time',
            [
                'label' => __('End Time', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '17:45',
                'condition' => [
                    'all_day_event!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'time_zone',
            [
                'label' => __('Time Zone', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'US/Mountain',
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => __('Location', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('World Wide Web', 'add-to-calender'),
            ]
        );

        $this->add_control(
            'availability',
            [
                'label' => __('Availability', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
               'options' => [
					'free' => __('Free', 'add-to-calender'),
                    'busy' => __('Busy', 'add-to-calender'),
				],
            ]
        );

        $this->add_control(
            'organizer_name',
            [
                'label' => __('Organizer Name', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'organizer_email',
            [
                'label' => __('Organizer Email','add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
            );
        
        $this->add_control(
            'ics_file_link',
            [
                'label' => __('Existing ICS File Link', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::URL
                ]
        );

        $this->add_control(
            'ics_file_name',
            [
                'label' => __('ICS File Name', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Event to Save'
                ]
        );


        $this->add_control(
			'options',
			[
				'label' => esc_html__( 'Calendar Options', 'add-to-calender' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'Apple' => __('Apple', 'add-to-calender'),
                    'Google' => __('Google', 'add-to-calender'),
                    'iCal' => __('ICS File', 'add-to-calender'),
                    'Outlook.com' => __('Outlook.com', 'add-to-calender'),
                    'Microsoft 365' => __('Microsoft 365', 'add-to-calender'),
                    'Microsoft Teams' => __('Microsoft Teams', 'add-to-calender'),
                    'Yahoo' => __('Yahoo', 'add-to-calender'),
				],
				 'default' => ['Google', 'Outlook.com'],
			]
		);

        $this->add_control(
			'past_date_handle',
			[
				'label' => esc_html__( 'Past date handle', 'add-to-calender' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'none' => __('No past date handle', 'add-to-calender'),
                    'disable' => __('Disable event', 'add-to-calender'),
                    'hide' => __('Hide event', 'add-to-calender'),
				],
				 'default' => ['none'],
			]
		);

        $this->add_control(
            'label',
            [
                'label' => __('Button Name', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Add to Calendar', 'add-to-calender'),
            ]
        );

        $this->add_control(
            'recurring_event', 
            [
                'label' => __('Recurring Event', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'add-to-calender' ),
                'label_off' => esc_html__( 'No', 'add-to-calender' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'recurring_frequency',
            [
                'label' => __('Recurring Frequency', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'daily' => __('Daily', 'add-to-calender'),
                    'weekly' => __('Weekly', 'add-to-calender'),
                    'monthly' => __('Monthly', 'add-to-calender'),
                    'yearly' => __('Yearly', 'add-to-calender'),
                ],
                'default' => 'weekly',
                'condition' => [
                    'recurring_event' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'recurring_interval',
            [
                'label' => __('Recurring Interval', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '1',
                'condition' => [
                    'recurring_event' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'recurring_count',
            [
                'label' => __('Recurring Count','add-to-calender'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '1',
                'condition' => [
                    'recurring_event' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'recurrence_byDay',
            [
                'label' => __('WeekDays when the event will occur', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => [
                    'MO' => __('Monday', 'add-to-calender'),
                    'TU' => __('Tuesday', 'add-to-calender'),
                    'WE' => __('Wednesday', 'add-to-calender'),
                    'TH' => __('Thursday', 'add-to-calender'),
                    'FR' => __('Friday', 'add-to-calender'),
                    'SA' => __('Saturday', 'add-to-calender'),
                    'SU' => __('Sunday', 'add-to-calender'),
                ],
                'multiple'=> true,
                'condition' => [
                    'recurring_event' => 'yes',
                    'recurring_frequency' => 'weekly',
                ],
            ]
        );
        $this->add_control(
            'recurrence_byDay_number', 
            [
                'label' => __('Number if any specific number of weekday like 3rd Friday','add-to-calender'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'max' => '4',
                'condition' => [
                    'recurring_event' => 'yes',
                    'recurring_frequency' => 'weekly',
                ],
            ]
        );
        $this->add_control(
            'recurrence_byMonthDay',
            [
                'label' => __('Number if any specific number of monthday like 3rd Friday','add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => [
                    '1' => __('1', 'add-to-calender'),
                    '2' => __('2', 'add-to-calender'),
                    '3' => __('3', 'add-to-calender'),
                    '4' => __('4', 'add-to-calender'),
                    '5' => __('5', 'add-to-calender'),
                    '6' => __('6', 'add-to-calender'),
                    '7' => __('7', 'add-to-calender'),
                    '8' => __('8', 'add-to-calender'),
                    '9' => __('9', 'add-to-calender'),
                    '10' => __('10', 'add-to-calender'),
                    '11' => __('11', 'add-to-calender'),
                    '12' => __('12', 'add-to-calender'),
                    '13' => __('13', 'add-to-calender'),
                    '14' => __('14', 'add-to-calender'),
                    '15' => __('15', 'add-to-calender'),
                    '16' => __('16', 'add-to-calender'),
                    '17' => __('17', 'add-to-calender'),
                    '18' => __('18', 'add-to-calender'),
                    '19' => __('19', 'add-to-calender'),
                    '20' => __('20', 'add-to-calender'),
                    '21' => __('21', 'add-to-calender'),
                    '22' => __('22', 'add-to-calender'),
                    '23' => __('23', 'add-to-calender'),
                    '24' => __('24', 'add-to-calender'),
                    '25' => __('25', 'add-to-calender'),
                    '26' => __('26', 'add-to-calender'),
                    '27' => __('27', 'add-to-calender'),
                    '28' => __('28', 'add-to-calender'),
                    '29' => __('29', 'add-to-calender'),
                    '30' => __('30', 'add-to-calender'),
                    '31' => __('31', 'add-to-calender'),
                ],
                'multiple' => true,
                'condition' => [
                    'recurring_event' => 'yes',
                    'recurring_frequency' => 'monthly',
                ],
            ]
        );

        $this->add_control(
            'recurrence_byMonth',
            [
                'label' => __('Which month this event will happen', ''),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => [
                    ' '
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style Options', 'add-to-calender'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_type',
            [
                'label' => __('List Type', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'dropdown' => __('Dropdown', 'add-to-calender'),
                    'dropdown-static' => __('Dropdown Static', 'add-to-calender'),
                    'dropup-static' => __('Dropup Static', 'add-to-calender'),
                    'modal' => __('Modal', 'add-to-calender'),
                    'overlay' => __('Overlay', 'add-to-calender'),
                ],
                'default' => 'dropdown',
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => __('Button Style', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => __('Default', 'add-to-calender'),
                     '3d' => __('3d', 'add-to-calender'),
                     'flat' => __('Flat', 'add-to-calender'),
                    'round' => __('Round', 'add-to-calender'),
                    'neumorphism' => __('Neumorphism', 'add-to-calender'),
                    'text' => __('Text', 'add-to-calender'),
                    'date' => __('Date', 'add-to-calender'),
                ],
                'default' => 'default',
            ]
        );

         
        $this->add_control(
            'show_button_as_list',
            [
                'label' => __('Show Button As List', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'add-to-calender' ),
				'label_off' => esc_html__( 'Hide', 'add-to-calender' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
			'hide_icons',
			[
				'label' => esc_html__( 'Hide Calendar Icons', 'add-to-calender' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'hideIconButton' => __('Button Icons', 'add-to-calender'),
                    'hideIconList' => __('List Icons', 'add-to-calender'),
                    'hideIconModal' => __('Modal Icons', 'add-to-calender'),
				]
			]
		);

        $this->add_control(
			'hide_texts',
			[
				'label' => esc_html__( 'Hide Calendar Texts', 'add-to-calender' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'hideTextLabelButton' => __('Button Text', 'add-to-calender'),
                    'hideTextLabelList' => __('List Text', 'add-to-calender'),
				]
			]
		);

        $this->add_control(
            'show_checkmark',
            [
                'label' => __('Show Checkmark', 'add-to-calender'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'add-to-calender' ),
				'label_off' => esc_html__( 'Hide', 'add-to-calender' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * @return void
     * @since 1.0.0
     */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$options = !empty($settings['options']) ? "'" . implode("','", $settings['options']) . "'" : '';
         // Ensure end date is not before start date
        if (strtotime($settings['end_date']) < strtotime($settings['start_date'])) {
            $settings['end_date'] = $settings['start_date'];
        }

        $all_day_event = $settings['all_day_event'];
        $start_date = date('Y-m-d', strtotime($settings['start_date']));
        $end_date = date('Y-m-d', strtotime($settings['end_date']));

        $hide_icons = !empty($settings['hide_icons']) ? implode(" ", $settings['hide_icons']) : '';
        $hide_texts = !empty($settings['hide_texts']) ? implode(" ", $settings['hide_texts']) : '';
         ?>
          <add-to-calendar-button 
            name="<?php echo esc_attr($settings['name']);?>"
            description="<?php echo esc_attr($settings['description']);?>"
            startDate="<?php echo esc_attr($start_date);?>"
            <?php if( 'no' == $all_day_event ):?>
            startTime="<?php echo esc_attr($settings['start_time']);?>"
            endDate="<?php echo esc_attr($end_date);?>"
            endTime="<?php echo esc_attr($settings['end_time']);?>"
            <?php endif;?>
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

    /**
     * Render widget output in the editor.
     *
     * @return void
     * @since 1.0.0
     */
    protected function content_template() {
        ?>
        <#
        var start_date = settings.start_date;
        var end_date = settings.end_date;

        if ( end_date < start_date ) {
            end_date = start_date;
        }

        var options = settings.options ? "'" + settings.options.join("','") + "'" : '';
        var hide_icons = settings.hide_icons ? settings.hide_icons.join(' ') : '';
        var hide_texts = settings.hide_texts ? settings.hide_texts.join(' ') : '';
        var past_date_handle = Array.isArray(settings.past_date_handle) ? settings.past_date_handle.join('') : settings.past_date_handle;
        var all_day_event = settings.all_day_event;
        #>
        <add-to-calendar-button 
            name="{{ settings.name }}"
            description="{{ settings.description }}"
            startDate="{{ start_date }}"
            <# if( 'no' == all_day_event ) { #>
            startTime="{{ settings.start_time }}"
            endDate="{{ end_date }}"
            endTime="{{ settings.end_time }}"
            <# } #> 
            timeZone="{{ settings.time_zone }}"
            location="{{ settings.location }}"
            <# if( settings.organizer_name && settings.organizer_email ) { 
                 if ( /.+@.+/.test(settings.organizer_email) ) { #>
                    organizer="{{ settings.organizer_name }}|{{ settings.organizer_email }}"
                <# } 
               } #>
            <# if( settings.ics_file_link && settings.ics_file_link.url ) { #>
                icsFile="{{ settings.ics_file_link.url }}"
            <# } #>    
            <# if( settings.availability ) { #>
                availability="{{ settings.availability }}"
            <# } #>
            <# if( settings.ics_file_name ) { #>
                iCalFileName="{{ settings.ics_file_name }}"
            <# } #> 
            options="{{ options }}"
            listStyle="{{ settings.list_type }}"
            buttonStyle="{{ settings.button_style }}"
            <# if( hide_icons ) { #>
                {{ hide_icons }}
            <# } #>
            <# if( hide_texts ) { #>
                {{ hide_texts }}
            <# } #>    
            <# if('yes' == settings.show_button_as_list) { #>
                buttonsList
            <# } #>   
            pastDateHandling="{{ past_date_handle }}" 
            <# if('yes' != settings.show_checkmark) { #>
                hideCheckmark
            <# } #>
            label = "{{ settings.label }}"
        ></add-to-calendar-button>

        <script>
        (function() {
            var fixShadow = function() {
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
            };
            if (document.readyState === 'loading') {
                document.addEventListener("DOMContentLoaded", fixShadow);
            } else {
                fixShadow();
            }
        })();
        </script>
        <?php
    }
}