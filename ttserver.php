<?php
/**
 *@Created 2010-12-3
 *@author sunli
 *@copyright dev@ifeng.com
 *@version $Id$
 */

require 'class/BigEndianSocketBuffer.php';
require 'class/BigEndianBytesBuffer.php';
require 'TT.php';
class TTServerRep {
	/**
	 * BigEndianSocketBuffer
	 *
	 * @var BigEndianSocketBuffer
	 */
	private $fd;
	public function __construct($host, $port, $rts, $sid) {
		$this->fd = new BigEndianSocketBuffer ( $host, $port );
		$this->fd->writeChar ( 0xC8 );
		$this->fd->writeChar ( 0xa0 );
		echo "\r\nstarted at:$rts\r\n";
		$this->fd->writeLong ( $rts );
		$this->fd->writeInt ( $sid );
		$this->fd->readInt ();
	}
	public function start() {
		$i = 0;
		while ( ($data = $this->readBuf ()) != null ) {
			$i ++;
			if ($i > 10) {
				break;
			}
			if ($data ['rsize'] == 0) { //no operation
				echo "no data\r\n";
				continue;
			}
			
			$buffer = new BigEndianBytesBuffer ( $data ['buf'] );
			file_put_contents ( 'rts', $data ['rts'] );
			$magic = $buffer->readUnsignedChar ();
			$cmd = $buffer->readUnsignedChar ();
			if ($magic != TT::$TTMAGICNUM) {
				echo "error data\r\n";
				return;
			}
			$size = $data ['rsize'] - 3;
			switch ($cmd) {
				case TT::$TTCMDPUT : // put
					if ($size > 8) {
						$keysize = $buffer->readInt ();
						$vsize = $buffer->readInt ();
						$key = $buffer->readBytes ( $keysize );
						$value = $buffer->readBytes ( $vsize );
						//$vbuffer = new BytesBuffer ( $value );
						//$flag = $vbuffer->readInt ();
						//$vdata = $vbuffer->readBytes ( $vsize - 4 );
						echo "put:" . $key . "=>" . $value . "\r\n";
						$buffer->readUnsignedChar ();
					} else {
						//error
					}
					break;
				case TT::$TTCMDOUT :
					if ($size >= 4) {
						$keysize = $buffer->readInt ();
						$key = $buffer->readBytes ( $keysize );
						echo "delete=>" . $key . "<br>\r\n";
					}
					break;
				case TT::$TTCMDVANISH :
					if ($size == 0) {
						echo "varnish=><br>\r\n";
					}
					break;
			}
		
		}
	
	}
	/**
	 * Enter description here...
	 *
	 * @param SocketBuffer $socketBuffer
	 */
	private function readBuf() {
		$socketBuffer = $this->fd;
		$data = null;
		$c = $socketBuffer->readUnsignedChar ();
		if ($c == 0xca) {
			$data ['rsize'] = 0;
			$data ['rts'] = 0;
			$data ['rsid'] = 0;
			$data ['buf'] = "";
			return $data;
		}
		if ($c != 0xc9) {
			return null;
		}
		$data ['rts'] = $socketBuffer->readLong ();
		$data ['rsid'] = $socketBuffer->readInt ();
		$data ['rsize'] = $socketBuffer->readInt ();
		$data ['buf'] = $socketBuffer->readBytes ( $data ['rsize'] );
		return $data;
	}

}
while ( true ) {
	$rts =trim(file_get_contents ( 'rts' ));
	if (intval ( $rts ) == 0) {
		$rts = 1;
	}
	$queue = new TTServerRep ( '192.168.50.180', 1978, bcadd($rts,1), 100 );
	$queue->start ();
}
?>