<?php
namespace library\image\rotate;
class gd implements \library\image\rotate
{
	public function rotate(\library\image\handle $handle, $angle='auto', $background='#000000')
	{
		$background = hexdec(ltrim($background, '#'));
		$resource   = $handle->getResource();

		if($angle==='auto') {
			$orientation = $handle->getOrientation();
			switch($orientation) {
				case 3: $angle = 180; break;
				case 6: $angle = -90; break;
				case 8: $angle = 90;  break;
				default : return $resource;
			}
		} else {
			$angle = intval($angle);
		}

		return imagerotate($resource, $angle, $background);
	}
}
