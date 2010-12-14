<?php
/**
 * PHP bytes array operation  API
 * 
 * Copyright (c) 2010 孙立 <sunli1223ATgmail.com>
 * 
 * @version    $Id$
 * @author     孙立 <sunli1223ATgmail.com>
 * @link       http://sunli.cnblogs.com
 */
class TT {
	public static $TTDEFPORT = 1978; // default port of the server */
	public static $TTMAGICNUM = 0xc8; // magic number of each command */
	public static $TTCMDPUT = 0x10; // ID of put command */
	public static $TTCMDPUTKEEP = 0x11; // ID of putkeep command */
	public static $TTCMDPUTCAT = 0x12; // ID of putcat command */
	public static $TTCMDPUTSHL = 0x13; // ID of putshl command */
	public static $TTCMDPUTNR = 0x18; // ID of putnr command */
	public static $TTCMDOUT = 0x20; // ID of out command */
	public static $TTCMDGET = 0x30; // ID of get command */
	public static $TTCMDMGET = 0x31; // ID of mget command */
	public static $TTCMDVSIZ = 0x38; // ID of vsiz command */
	public static $TTCMDITERINIT = 0x50; // ID of iterinit command */
	public static $TTCMDITERNEXT = 0x51; // ID of iternext command */
	public static $TTCMDFWMKEYS = 0x58; // ID of fwmkeys command */
	public static $TTCMDADDINT = 0x60; // ID of addint command */
	public static $TTCMDADDDOUBLE = 0x61; // ID of adddouble command */
	public static $TTCMDEXT = 0x68; // ID of ext command */
	public static $TTCMDSYNC = 0x70; // ID of sync command */
	public static $TTCMDOPTIMIZE = 0x71; // ID of optimize command */
	public static $TTCMDVANISH = 0x72; // ID of vanish command */
	public static $TTCMDCOPY = 0x73; // ID of copy command */
	public static $TTCMDRESTORE = 0x74; // ID of restore command */
	public static $TTCMDSETMST = 0x78; // ID of setmst command */
	public static $TTCMDRNUM = 0x80; // ID of rnum command */
	public static $TTCMDSIZE = 0x81; // ID of size command */
	public static $TTCMDSTAT = 0x88; // ID of stat command */
	public static $TTCMDMISC = 0x90; // ID of misc command */
	public static $TTCMDREPL = 0xa0; // ID of repl command */
	

	public static $TTTIMERMAX = 8; // maximum number of timers */
	

	public static $TCULMAGICNUM = 0xc9; /* magic number of each command */
	public static $TCULMAGICNOP = 0xca; /* magic number of NOP command */
}
?>