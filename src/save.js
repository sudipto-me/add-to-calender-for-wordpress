/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';

import AddToCalender from './components/AddToCalender';

/**
 * Save the block markup to post content.
 *
 * @param {Object} props            Block props.
 * @param {Object} props.attributes Block attributes.
 * @return {Element} Element to render.
 */
export default function save( { attributes } ) {
	const blockProps = useBlockProps.save( {
		className: 'wp-block-add-to-calender-for-wordpress',
	} );

	return (
		<div { ...blockProps }>
			<AddToCalender { ...attributes } />
		</div>
	);
}
