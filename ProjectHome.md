phpbuffer is used to serialize php object and that communicate with other language.

sample1:
```
require 'class/BigEndianBytesBuffer.php';
class request {
	public $width = 5;
	public $height = 6;
	private $buffer;
	public function __construct() {
		
		$this->buffer = new BigEndianBytesBuffer ( );
	}
	public function tobytes() {
		$this->buffer->clear ();
		$this->buffer->writeInt ( $this->width );
		$this->buffer->writeInt ( $this->height );
		return $this->buffer;
	}
}

```
sample2: read data from a binary file  which is written  by java code.
```
	public static void main(String[] args) throws IOException {
		RandomAccessFile file = new RandomAccessFile("db", "rw");
		file.write(100);
		file.writeShort(101);
		file.writeInt(100000);
		file.writeLong(4000000000L);
		file.writeBytes("test");
		file.close();
	}
```
and php like following.
```

/**
 * get file buffer
 *
 * @return BigEndianBuffer
 */
function getfile(){
return new BigEndianBytesBuffer(file_get_contents('db'));
}
$buffer=getfile();
echo $buffer->readBytes(1);
echo "\r\n";
echo $buffer->readShort();
echo "\r\n";

echo $buffer->readInt();
echo "\r\n";
echo $buffer->readLong();
echo "\r\n";
echo $buffer->readBytes(4);
echo "\r\n";

```
will output
```
100
101
100000
4000000000
test
```
and you can use it in socket programe like this,
```
	$this->fd = new BigEndianSocketBuffer ( $host, $port );
		$this->fd->writeChar ( 0xC8 );
		$this->fd->writeChar ( 0xa0 );
		echo "\r\nstarted at:$rts\r\n";
		$this->fd->writeLong ( $rts );
		$this->fd->writeInt ( $sid );
		$this->fd->readInt ();
```