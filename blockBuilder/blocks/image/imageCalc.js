// image_calc.js

/* media as it comes from MediaUpload component */

export function isPortrait (media)  {
  if (media.height > media.width) {
    return true;
  }
  return false;
}

export function isLandscape (media) {
  if (media.height < media.width) {
    return true;
  }
  return false;
}

export function isSquare (media) {
  if (media.height === media.width) {
    return true;
  }
  return false;
}

