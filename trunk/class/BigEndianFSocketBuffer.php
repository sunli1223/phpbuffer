<?php
/**
 * PHP bytes array operation  API
 * 
 * Copyright (c) 2010 sunli <sunli1223ATgmail.com>
 * 
 * @version    $Id$
 * @author     sunli <sunli1223ATgmail.com>
 * @link       http://sunli.cnblogs.com
 */
require_once dirname ( __FILE__ ) . '/BigEndianBuffer.php';
class BigEndianSocketBuffer extends BigEndianBuffer {
	private $socket;
	private $buffer;
	public function __construct($host, $port) {
		$this->socket = fsockopen ( $host, $port, $errno, $errstr, 30 );
		echo $errno;
	}
	public function readBytes($len) {
		return fread ( $this->socket, $len );
	}
	/**
	 * @see BigEndianBuffer::writeBytes()
	 *
	 * @param bytes $bytes
	 */
	public function writeBytes($bytes) {
		fwrite ( $this->socket, $bytes );
	}

}
?>