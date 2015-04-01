# Introduction #
phpbuffer can  serialize some php object to bytes ，write to and read from a binary  file or binary protocol.

# sample #

```
<?php
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
?>
```