/* this is what gets shown in editor */

import classnames from 'classnames';

// import './editor.scss';

function Section( { rowGap, imagePos, align, className, children, ...props } ) {
	const wrapperClasses = classnames(
		'wp-block-hero',
		className,
		`align-${ align }`
	);
	const innerClasses = classnames(
		'wp-block-hero-inner',
		`${ rowGap }`,
		`image-${ imagePos }`,
		// `is-${ contentMaxWidth || 'site' }-width`,
	);
	return (
		<section
			className={ wrapperClasses }
			{ ...props }
		>

			<div
				className={ innerClasses }
			>
				{ children }
			</div>
		</section>
	);
}

export default Section;
