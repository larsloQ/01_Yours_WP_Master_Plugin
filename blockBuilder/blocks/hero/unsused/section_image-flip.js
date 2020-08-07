/* this is what gets shown in editor */

import classnames from 'classnames';

import './editor.scss';

function Section( { rowGap, imagePos, contentMaxWidth, className, children, ...props } ) {
  const wrapperClasses = classnames(
    "wp-block-imageflip",
    className
  );
  const innerClasses = classnames(
    'wp-block-imageflip-inner',
    `${rowGap}`,
    `image-${imagePos}`,
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