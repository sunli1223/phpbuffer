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
		$this->socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP );
		socket_connect ( $this->socket, $host, $port );
		socket_set_option ( $this->socket, SOL_TCP, 1, 1 );
		//socket_set_option ( $this->socket, SOL_TCP, SO_SNDBUF, 1024 * 1024 );
	}
	/**
	 * @see BigEndianBuffer::readBytes()
	 *
	 * @param int $len
	 * @return bytes
	 */
	public function readBytes($len) {
		if (is_null ( $len ) || $len < 1) {
			return false;
		}
		$str = "";
		$bufferLen = strlen ( $this->buffer );
		if ($bufferLen > 0) {
			if ($len > $bufferLen) {
				$str = $this->buffer;
				$this->buffer = null;
				$len = $len - $bufferLen;
			} else {
				$str = substr ( $this->buffer, 0, $len );
				$this->buffer = substr ( $this->buffer, $len );
				return $str;
			}
		
		}
		if (($rec = socket_recv ( $this->socket, $strSocket, $len, 0 )) <= 0) {
			return false;
		}
		$str .= $strSocket;
		if (strlen ( $str ) == $len) {
			return $str;
		}
		$len -= strlen ( $str );
		while ( $len > 0 ) {
			$tstr = "";
			if (($rec = socket_recv ( $this->socket, $tstr, $len, 0 )) <= 0) {
				return false;
			}
			$len -= strlen ( $tstr );
			$str .= $tstr;
		}
		return $str;
	}
	
	/**
	 * @see BigEndianBuffer::writeBytes()
	 *
	 * @param bytes $bytes
	 */
	public function writeBytes($bytes) {
		socket_write ( $this->socket, $bytes );
	}

}
?>