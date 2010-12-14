<?php
/**
 *@Created 2010-11-1
 *@author sunli
 *@copyright dev@ifeng.com
 *@version $Id$
 */

require 'class/BigEndianBytesBuffer.php';
class request {
	public $width = 5;
	public $height = 6;
	private $buffer;
	public function __construct() {
		$this->buffer = new BigEndianBytesBuffer ( '' );
	}
	public function tobytes() {
		$this->buffer->clear ();
		$this->buffer->writeInt ( $this->width );
		$this->buffer->writeInt ( $this->height );
		return $this->buffer;
	}
	/**
	 * Enter description here...
	 *
	 * @param BigEndianBuffer $buffer
	 */
	public function frombytes($buffer) {
		$this->width = $buffer->readInt ();
		$this->height = $buffer->readInt ();
	}
}
/**
 * get file buffer
 *
 * @return BigEndianBuffer
 */
function getfile(){
return new BigEndianBytesBuffer(file_get_contents('db'));
}
$buffer=getfile();
echo $buffer->readChar();
echo "\r\n";
echo $buffer->readShort();
echo "\r\n";

echo $buffer->readInt();
echo "\r\n";
echo $buffer->readLong();
echo "\r\n";
echo $buffer->readBytes(4);
echo "\r\n";
?>