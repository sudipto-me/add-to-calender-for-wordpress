/**
 * WordPress dependencies
 */
import { RawHTML } from '@wordpress/element';

/**
 * Escape a value for use inside a double-quoted HTML attribute.
 *
 * @param {string} value Raw attribute value.
 * @return {string} Escaped value.
 */
function escapeAttribute( value ) {
	return String( value )
		.replace( /&/g, '&amp;' )
		.replace( /"/g, '&quot;' )
		.replace( /</g, '&lt;' )
		.replace( /\n/g, ' ' );
}

/**
 * Build <add-to-calendar-button> markup.
 *
 * Attribute names are lowercased on purpose:
 * - HTML parsers always lowercase attribute names
 * - ATCB observes attributes via name.toLowerCase()
 * - Gutenberg block validation compares save() output to parsed HTML;
 *   camelCase save markup never matches and the block stays "invalid",
 *   so old HTML (without buttonslist/hidecheckmark) is kept forever.
 *
 * @param {Object} props Block attributes.
 * @return {string} HTML string.
 */
function buildMarkup( {
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
} ) {
	const attrs = [];

	const add = ( name, value ) => {
		if ( value === undefined || value === null || value === '' ) {
			return;
		}
		attrs.push(
			`${ String( name ).toLowerCase() }="${ escapeAttribute( value ) }"`
		);
	};

	// ATCB accepts name="true". Bare boolean attrs are unreliable in saved HTML.
	const addBool = ( name, enabled ) => {
		if ( enabled ) {
			attrs.push( `${ String( name ).toLowerCase() }="true"` );
		}
	};

	const safeEndDate =
		endDate && startDate && endDate < startDate ? startDate : endDate;

	const options =
		Array.isArray( calendarOptions ) && calendarOptions.length
			? `'${ calendarOptions.join( "','" ) }'`
			: '';

	const isValidEmail = ( email ) =>
		typeof email === 'string' && /.+@.+\..+/.test( email );

	const organizer =
		organizerName && isValidEmail( organizerEmail )
			? `${ organizerName }|${ organizerEmail }`
			: '';

	add( 'name', eventName );
	add( 'description', description );
	add( 'startDate', startDate );

	if ( ! allDayEvent ) {
		add( 'startTime', startTime );
		add( 'endDate', safeEndDate );
		add( 'endTime', endTime );
	}

	add( 'timeZone', timeZone );
	add( 'location', location );
	add( 'availability', availability );
	add( 'organizer', organizer );
	add( 'icsFile', icsFileUrl );
	add( 'iCalFileName', icsFileName );
	add( 'options', options );
	add( 'pastDateHandling', pastDateHandling || 'none' );
	add( 'label', label );
	add( 'listStyle', listStyle );
	add( 'buttonStyle', buttonStyle );

	addBool( 'buttonsList', !! buttonsList );

	( hideIcons || [] ).forEach( ( name ) => addBool( name, true ) );
	( hideTexts || [] ).forEach( ( name ) => addBool( name, true ) );

	addBool( 'hideCheckmark', showCheckmark === false );

	if ( recurringEvent ) {
		add( 'recurrence', recurringFrequency );
		add( 'recurrence_interval', String( recurringInterval ) );
		add( 'recurrence_count', String( recurringCount ) );

		if ( recurringFrequency === 'weekly' && recurrenceByDay?.length ) {
			add( 'recurrence_byDay', recurrenceByDay.join( ',' ) );
			if ( recurrenceByDayNumber ) {
				add(
					'recurrence_byDay_number',
					String( recurrenceByDayNumber )
				);
			}
		}

		if ( recurringFrequency === 'monthly' ) {
			if ( recurrenceByMonth?.length ) {
				add( 'recurrence_byMonth', recurrenceByMonth.join( ',' ) );
			}
			if ( recurrenceByMonthDay?.length ) {
				add(
					'recurrence_byMonthDay',
					recurrenceByMonthDay.join( ',' )
				);
			}
		}
	}

	return `<add-to-calendar-button ${ attrs.join( ' ' ) }></add-to-calendar-button>`;
}

/**
 * Renders the Add to Calender web component from block attributes.
 *
 * @param {Object} props Block attributes.
 * @return {Element} Markup for editor preview and saved post content.
 */
export default function AddToCalender( props ) {
	return <RawHTML>{ buildMarkup( props ) }</RawHTML>;
}
