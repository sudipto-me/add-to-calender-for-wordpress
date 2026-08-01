/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	TextareaControl,
	ToggleControl,
	SelectControl,
	FormTokenField,
	__experimentalNumberControl as NumberControl,
} from '@wordpress/components';

import './editor.scss';
import AddToCalender from './components/AddToCalender';

const CALENDAR_OPTION_SUGGESTIONS = [
	'Apple',
	'Google',
	'iCal',
	'Outlook.com',
	'Microsoft 365',
	'Microsoft Teams',
	'Yahoo',
];

const WEEKDAY_SUGGESTIONS = [ 'MO', 'TU', 'WE', 'TH', 'FR', 'SA', 'SU' ];

const MONTH_SUGGESTIONS = [
	'1',
	'2',
	'3',
	'4',
	'5',
	'6',
	'7',
	'8',
	'9',
	'10',
	'11',
	'12',
];

const MONTH_DAY_SUGGESTIONS = Array.from( { length: 31 }, ( _, i ) =>
	String( i + 1 )
);

const HIDE_ICON_SUGGESTIONS = [
	'hideIconButton',
	'hideIconList',
	'hideIconModal',
];

const HIDE_TEXT_SUGGESTIONS = [ 'hideTextLabelButton', 'hideTextLabelList' ];

/**
 * Local calendar date as YYYY-MM-DD.
 *
 * @return {string} Today's date in the browser timezone.
 */
function getTodayDate() {
	const date = new Date();
	const year = date.getFullYear();
	const month = String( date.getMonth() + 1 ).padStart( 2, '0' );
	const day = String( date.getDate() ).padStart( 2, '0' );

	return `${ year }-${ month }-${ day }`;
}

/**
 * Block editor UI.
 *
 * @param {Object}   props               Block props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Update attributes.
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const {
		eventName,
		description,
		startDate,
		allDayEvent,
		startTime,
		endDate,
		endTime,
		timeZone,
		location,
		availability,
		organizerName,
		organizerEmail,
		icsFileUrl,
		icsFileName,
		calendarOptions,
		pastDateHandling,
		label,
		recurringEvent,
		recurringFrequency,
		recurringInterval,
		recurringCount,
		recurrenceByDay,
		recurrenceByDayNumber,
		recurrenceByMonthDay,
		recurrenceByMonth,
		listStyle,
		buttonStyle,
		buttonsList,
		hideIcons,
		hideTexts,
		showCheckmark,
	} = attributes;

	// New blocks start with empty dates; seed both to today once.
	useEffect( () => {
		if ( startDate && endDate ) {
			return;
		}

		const today = getTodayDate();
		setAttributes( {
			...( ! startDate ? { startDate: today } : {} ),
			...( ! endDate ? { endDate: today } : {} ),
		} );
	}, [ startDate, endDate, setAttributes ] );

	const blockProps = useBlockProps( {
		className: 'wp-block-add-to-calender-for-wordpress',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Event Details', 'add-to-calender' ) }>
					<TextControl
						label={ __( 'Event Name', 'add-to-calender' ) }
						value={ eventName }
						onChange={ ( value ) =>
							setAttributes( { eventName: value } )
						}
					/>
					<TextareaControl
						label={ __( 'Event Description', 'add-to-calender' ) }
						value={ description }
						onChange={ ( value ) =>
							setAttributes( { description: value } )
						}
					/>
					<TextControl
						label={ __( 'Start Date', 'add-to-calender' ) }
						help={ __( 'Format: YYYY-MM-DD', 'add-to-calender' ) }
						value={ startDate }
						onChange={ ( value ) =>
							setAttributes( { startDate: value } )
						}
					/>
					<ToggleControl
						label={ __( 'All Day Event', 'add-to-calender' ) }
						checked={ !! allDayEvent }
						onChange={ ( value ) =>
							setAttributes( { allDayEvent: value } )
						}
					/>
					{ ! allDayEvent && (
						<>
							<TextControl
								label={ __( 'Start Time', 'add-to-calender' ) }
								help={ __(
									'Format: HH:MM',
									'add-to-calender'
								) }
								value={ startTime }
								onChange={ ( value ) =>
									setAttributes( { startTime: value } )
								}
							/>
							<TextControl
								label={ __( 'End Date', 'add-to-calender' ) }
								help={ __(
									'Format: YYYY-MM-DD',
									'add-to-calender'
								) }
								value={ endDate }
								onChange={ ( value ) =>
									setAttributes( { endDate: value } )
								}
							/>
							<TextControl
								label={ __( 'End Time', 'add-to-calender' ) }
								help={ __(
									'Format: HH:MM',
									'add-to-calender'
								) }
								value={ endTime }
								onChange={ ( value ) =>
									setAttributes( { endTime: value } )
								}
							/>
						</>
					) }
					<TextControl
						label={ __( 'Time Zone', 'add-to-calender' ) }
						help={ __(
							'Example: Asia/Dhaka or US/Mountain',
							'add-to-calender'
						) }
						value={ timeZone }
						onChange={ ( value ) =>
							setAttributes( { timeZone: value } )
						}
					/>
					<TextControl
						label={ __( 'Location', 'add-to-calender' ) }
						value={ location }
						onChange={ ( value ) =>
							setAttributes( { location: value } )
						}
					/>
					<SelectControl
						label={ __( 'Availability', 'add-to-calender' ) }
						value={ availability }
						options={ [
							{
								label: __( '— Select —', 'add-to-calender' ),
								value: '',
							},
							{
								label: __( 'Free', 'add-to-calender' ),
								value: 'free',
							},
							{
								label: __( 'Busy', 'add-to-calender' ),
								value: 'busy',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { availability: value } )
						}
					/>
					<TextControl
						label={ __( 'Organizer Name', 'add-to-calender' ) }
						value={ organizerName }
						onChange={ ( value ) =>
							setAttributes( { organizerName: value } )
						}
					/>
					<TextControl
						label={ __( 'Organizer Email', 'add-to-calender' ) }
						type="email"
						value={ organizerEmail }
						onChange={ ( value ) =>
							setAttributes( { organizerEmail: value } )
						}
					/>
					<TextControl
						label={ __(
							'Existing ICS File Link',
							'add-to-calender'
						) }
						type="url"
						value={ icsFileUrl }
						onChange={ ( value ) =>
							setAttributes( { icsFileUrl: value } )
						}
					/>
					<TextControl
						label={ __( 'ICS File Name', 'add-to-calender' ) }
						value={ icsFileName }
						onChange={ ( value ) =>
							setAttributes( { icsFileName: value } )
						}
					/>
					<FormTokenField
						label={ __( 'Calendar Options', 'add-to-calender' ) }
						value={ calendarOptions }
						suggestions={ CALENDAR_OPTION_SUGGESTIONS }
						onChange={ ( value ) =>
							setAttributes( { calendarOptions: value } )
						}
						__experimentalExpandOnFocus
					/>
					<SelectControl
						label={ __( 'Past date handle', 'add-to-calender' ) }
						value={ pastDateHandling }
						options={ [
							{
								label: __(
									'No past date handle',
									'add-to-calender'
								),
								value: 'none',
							},
							{
								label: __(
									'Disable event',
									'add-to-calender'
								),
								value: 'disable',
							},
							{
								label: __( 'Hide event', 'add-to-calender' ),
								value: 'hide',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { pastDateHandling: value } )
						}
					/>
					<TextControl
						label={ __( 'Button Name', 'add-to-calender' ) }
						value={ label }
						onChange={ ( value ) =>
							setAttributes( { label: value } )
						}
					/>
				</PanelBody>

				<PanelBody
					title={ __( 'Recurrence', 'add-to-calender' ) }
					initialOpen={ false }
				>
					<ToggleControl
						label={ __( 'Recurring Event', 'add-to-calender' ) }
						checked={ !! recurringEvent }
						onChange={ ( value ) =>
							setAttributes( { recurringEvent: value } )
						}
					/>
					{ recurringEvent && (
						<>
							<SelectControl
								label={ __(
									'Recurring Frequency',
									'add-to-calender'
								) }
								value={ recurringFrequency }
								options={ [
									{
										label: __( 'Daily', 'add-to-calender' ),
										value: 'daily',
									},
									{
										label: __(
											'Weekly',
											'add-to-calender'
										),
										value: 'weekly',
									},
									{
										label: __(
											'Monthly',
											'add-to-calender'
										),
										value: 'monthly',
									},
									{
										label: __(
											'Yearly',
											'add-to-calender'
										),
										value: 'yearly',
									},
								] }
								onChange={ ( value ) =>
									setAttributes( {
										recurringFrequency: value,
									} )
								}
							/>
							<NumberControl
								label={ __(
									'Recurring Interval',
									'add-to-calender'
								) }
								value={ recurringInterval }
								min={ 1 }
								onChange={ ( value ) =>
									setAttributes( {
										recurringInterval:
											value === undefined ||
											value === ''
												? 1
												: Number( value ),
									} )
								}
							/>
							<NumberControl
								label={ __(
									'Recurring Count',
									'add-to-calender'
								) }
								value={ recurringCount }
								min={ 1 }
								onChange={ ( value ) =>
									setAttributes( {
										recurringCount:
											value === undefined ||
											value === ''
												? 1
												: Number( value ),
									} )
								}
							/>
							{ recurringFrequency === 'weekly' && (
								<>
									<FormTokenField
										label={ __(
											'Weekdays when the event will occur',
											'add-to-calender'
										) }
										value={ recurrenceByDay }
										suggestions={ WEEKDAY_SUGGESTIONS }
										onChange={ ( value ) =>
											setAttributes( {
												recurrenceByDay: value,
											} )
										}
										__experimentalExpandOnFocus
									/>
									<NumberControl
										label={ __(
											'Weekday number (e.g. 3rd Friday)',
											'add-to-calender'
										) }
										value={ recurrenceByDayNumber }
										min={ 0 }
										max={ 4 }
										onChange={ ( value ) =>
											setAttributes( {
												recurrenceByDayNumber:
													value === undefined ||
													value === ''
														? 0
														: Number( value ),
											} )
										}
									/>
								</>
							) }
							{ recurringFrequency === 'monthly' && (
								<>
									<FormTokenField
										label={ __(
											'Which month this event will happen',
											'add-to-calender'
										) }
										value={ recurrenceByMonth }
										suggestions={ MONTH_SUGGESTIONS }
										onChange={ ( value ) =>
											setAttributes( {
												recurrenceByMonth: value,
											} )
										}
										__experimentalExpandOnFocus
									/>
									<FormTokenField
										label={ __(
											'Month day numbers',
											'add-to-calender'
										) }
										value={ recurrenceByMonthDay }
										suggestions={ MONTH_DAY_SUGGESTIONS }
										onChange={ ( value ) =>
											setAttributes( {
												recurrenceByMonthDay: value,
											} )
										}
										__experimentalExpandOnFocus
									/>
								</>
							) }
						</>
					) }
				</PanelBody>

				<PanelBody
					title={ __( 'Style Options', 'add-to-calender' ) }
					initialOpen={ false }
				>
					<SelectControl
						label={ __( 'List Type', 'add-to-calender' ) }
						value={ listStyle }
						options={ [
							{
								label: __( 'Dropdown', 'add-to-calender' ),
								value: 'dropdown',
							},
							{
								label: __(
									'Dropdown Static',
									'add-to-calender'
								),
								value: 'dropdown-static',
							},
							{
								label: __(
									'Dropup Static',
									'add-to-calender'
								),
								value: 'dropup-static',
							},
							{
								label: __( 'Modal', 'add-to-calender' ),
								value: 'modal',
							},
							{
								label: __( 'Overlay', 'add-to-calender' ),
								value: 'overlay',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { listStyle: value } )
						}
					/>
					<SelectControl
						label={ __( 'Button Style', 'add-to-calender' ) }
						value={ buttonStyle }
						options={ [
							{
								label: __( 'Default', 'add-to-calender' ),
								value: 'default',
							},
							{
								label: __( '3d', 'add-to-calender' ),
								value: '3d',
							},
							{
								label: __( 'Flat', 'add-to-calender' ),
								value: 'flat',
							},
							{
								label: __( 'Round', 'add-to-calender' ),
								value: 'round',
							},
							{
								label: __( 'Neumorphism', 'add-to-calender' ),
								value: 'neumorphism',
							},
							{
								label: __( 'Text', 'add-to-calender' ),
								value: 'text',
							},
							{
								label: __( 'Date', 'add-to-calender' ),
								value: 'date',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { buttonStyle: value } )
						}
					/>
					<ToggleControl
						label={ __(
							'Show Button As List',
							'add-to-calender'
						) }
						checked={ !! buttonsList }
						onChange={ ( value ) =>
							setAttributes( { buttonsList: value } )
						}
					/>
					<FormTokenField
						label={ __(
							'Hide Calendar Icons',
							'add-to-calender'
						) }
						value={ hideIcons }
						suggestions={ HIDE_ICON_SUGGESTIONS }
						onChange={ ( value ) =>
							setAttributes( { hideIcons: value } )
						}
						__experimentalExpandOnFocus
					/>
					<FormTokenField
						label={ __(
							'Hide Calendar Texts',
							'add-to-calender'
						) }
						value={ hideTexts }
						suggestions={ HIDE_TEXT_SUGGESTIONS }
						onChange={ ( value ) =>
							setAttributes( { hideTexts: value } )
						}
						__experimentalExpandOnFocus
					/>
					<ToggleControl
						label={ __( 'Show Checkmark', 'add-to-calender' ) }
						checked={ !! showCheckmark }
						onChange={ ( value ) =>
							setAttributes( { showCheckmark: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<AddToCalender
					key={ [
						eventName,
						startDate,
						allDayEvent,
						startTime,
						endDate,
						endTime,
						timeZone,
						location,
						label,
						listStyle,
						buttonStyle,
						buttonsList,
						showCheckmark,
						recurringEvent,
						recurringFrequency,
						( calendarOptions || [] ).join( ',' ),
						( hideIcons || [] ).join( ',' ),
						( hideTexts || [] ).join( ',' ),
						( recurrenceByDay || [] ).join( ',' ),
						( recurrenceByMonth || [] ).join( ',' ),
						( recurrenceByMonthDay || [] ).join( ',' ),
					].join( '-' ) }
					{ ...attributes }
				/>
			</div>
		</>
	);
}
