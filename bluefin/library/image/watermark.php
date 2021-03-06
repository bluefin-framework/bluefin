<?php
namespace library\image;
interface watermark
{
	public function setX($x);
	public function setY($y);
	public function setFont($font);
	public function setSize($size);
	public function setColor($color);
	public function setOpacity($opacity);
	public function setAngle($angle);
	public function text(handle $handle, $text);
	public function image(handle $handle, $image);
	public function __set($option, $value);
}
