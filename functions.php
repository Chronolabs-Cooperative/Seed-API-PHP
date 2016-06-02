<?php
/**
 * Chronolabs Feeds File
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         feeds
 * @since           1.1.2
 * @author          Simon Roberts <meshy@labs.coop>
 * @version         $Id: functions.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		randomisation
 * @description		Random Seeding Feed Token Generator
 */

/**
 * pick()
 * Chooses a pick number using the pick class and script
 *
 * @param integer $min			Minimum in range to allot a pick from
 * @param integer $max			Maximum in range to allot a pick from
 * @return integer
 */
function pick($min, $max) {
	return mt_rand(intval($min), intval($max));
}

/**
 * regaldancing()
 * Strips a hash or code with regaldancing for defined definition of static variable
 *
 * @param string $string		Hash/Checksum/Code that wants to be stripped
 * @return string
 */
function regaldancing($string)
{
	$string = str_shuffle($string);
	static $sep, $num;
	if (empty($sep)) {
		switch(pick(0,3)) {
			case "0":
				$sep = '-';
				break;
			case "1":
				$sep = '::';
				break;
			case "2":
				$sep = ':';
				break;
			case "3":
				$sep = ':::';
				break;
		}
	}
	$ret = '';
	if (empty($num)) {
		$num = pick(4,9);
	}
	$uu = 0;
	$length = strlen($string);
	$regaldancing = floor(strlen($string) / $num);
	for ($i = 0; $i < strlen($string); $i++) {
		if ($i < $length) {
			$uu++;
			if ($uu == $regaldancing) {
				$ret .= substr($string, $i, 1) . $sep;
				$uu = 0;
			} else {
				if (substr($string, $i, 1) != $sep) {
					$ret .= substr($string, $i, 1);
				} else {
					$uu--;
				}
			}
		}
	}
	$ret = str_replace($sep.$sep, $sep, $ret);
	if (substr($ret, 0, 1) == $sep) {
		$ret = substr($ret, 2, strlen($ret));
	}
	if (substr($ret, strlen($ret) - 1, 1) == $sep) {
		$ret = substr($ret, 0, strlen($ret) - 1);
	}
	return $ret;
}

/**
 * plant()
 * Pulls Randomisation Seed from processes
 *
 * @param integer $now			Unix Date/Time Stamp
 * @param integer $func			Checksum Function to run (md5/sha1)
 * @return string
 */
function plant($now, $func) {
	$options = strval(pick(1, 35));
	switch ( $options ) {
		case '1':
			return '&#163; '. (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY')));
		case '2':
			return '$ '. (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY')));
		case '3':
			return (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('his'))) . '&#162;';
		case '4':
			return '&#163; '. (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY')));
		case '5':
			return '&#165; '. (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY')));
		case '6':
			return (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY'))) . '&#164;';
		case '7':
			return '$ '. (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY')));
		case '8':
			return (pick(1, 2) != 2 ? '': '-') . intval((pick(date('Hs'), $now / date('sH'))) . '.' . intval(pick(date('Hs'), $now ^ date('h')))) . ' &#8706; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '9':
			return ''. chr(pick(ord("A"), ord("A") + 23)) . chr(pick(ord("A"), ord("A") + 23)) . chr(pick(ord("A"), ord("A") + 23)) . ' &#8482; '. intval(pick(date('Yi'), $now)   / date('ihs'))  . (pick(1, 2) != 2 ? 'DA': (pick(0, 2) == 2 ? 'BC': 'AD'));
		case '10':
			return '&#189; of '. (pick(2, 4) != 4 ? '': '-') . intval(pick(date('ms'), $now) / pick(date('ds'), date('diY')))  . '.' . intval(pick(date('Hs'), intval($now)) / pick(date('dM'), date('dMY'))) ;
		case '11':
			return chr(pick(ord("A"), ord("A") + 23)) . chr(pick(ord("A"), ord("A") + 23)) . chr(pick(ord("A"), ord("A") + 23)) . ' &#169; ' . intval(pick(date('si'), $now)   / date('is')) .  (pick(1, 2) != 2 ? 'DA': (pick(0, 2) == 2 ? 'BC': 'AD'));
		case '13':
			return  chr(pick(ord("A"), ord("A") + 23)) . chr(pick(ord("A"), ord("A") + 23)) . chr(pick(ord("A"), ord("A") + 23)) . ' &#174; '. intval(pick(date('Yi'), $now)  / date('sH')) . (pick(1, 2) != 2 ? 'DA': (pick(0, 2) == 2 ? 'BC': 'AD'))  ;
		case '14':
			return '&#188; of '. (pick(2, 4) != 4 ? '': '-') . (pick(date('is'), $now) / pick(date('sM'), date('dhY')))  ;
		case '15':
			return '&#190; of '. (pick(2, 4) != 4 ? '': '-') . intval(pick(date('ms'), $now) / pick(date('ds'), date('diY')))  . '.' . intval(pick(date('Hs'), intval($now)) / pick(date('dM'), date('dMY'))) ;
		case '16':
			return '$ '. (pick(1, 2) != 2 ? '': '-') . intval(pick(date('Hs'), $now) / date('H')) . '.' . intval(pick(date('iM'), $now) / date('si')) ;
		case '17':
			return (pick(0, 360) . '.' . pick(date('Hs'), $now)) . '&#176;';
		case '18':
			return (pick(date('His'), $now) . '.' . pick(date('Hs'), $now)) . '&#8240;';
		case '19':
			return '&#8364; '. (pick(1, 2) != 2 ? '': '-') . (pick(date('Hs'), $now) / pick(date('dM'), date('dMY')));
		case '20':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8711; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '21':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8712; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '22':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8713; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '23':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8715; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '24':
			$ruck = array('A','2','3','4','5','6','7','8','9','J','Q','K');
			$node = array('&#9824','&#9827','&#9829','&#9830');
			return $ruck[pick(0, count($ruck)-1)] . $node[pick(0, count($node)-1)];
		case '25':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8855; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '26':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8853; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '27':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8839; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '28':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8838; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '29':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8836; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '30':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8800; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '31':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8756; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '32':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8733; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '33':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8730; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		case '34':
			return (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) . ' &#8721; '. (pick(1, 2) != 2 ? '': '-') . ((pick(date('Hs'), $now / date('sH'))) . '.' . (pick(date('Hs'), $now ^ date('h')))) ;
		default:
			return regaldancing($func(microtime(true)));
	}
	return (pick(1, 2)==1 ? '-': '+') .  (pick(date('Hs'), $now) . '.' . pick(date('Hs'), $now) ^ pick(date('is'), date('dMY'))) ;
}

/**
 * cipherism()
 * Generates Randomisation Seed
 *
 * @param integer $weight			Minimum in range to allot a pick from
 * @param integer $done			Maximum in range to allot a pick from
 * @return integer
 */
function cipherism($weight = 0, $done = 10) {
		
	switch(pick(0,3)) {
		case "0" :
			$funca = 'md5';
			$funcb = 'sha1';
			break;
		case "1" :
			$funca = 'sha1';
			$funcb = 'md5';
			break;
		case "2" :
			$funca = 'md5';
			$funcb = 'md5';
			break;
		case "3" :
			$funca = 'sha1';
			$funcb = 'sha1';
			break;
	}

	switch(pick(0,36)) {
		case "0" :
			$open = '[';
			$close = ']';
			break;
		case "1" :
			$open = '(';
			$close = ')';
			break;
		case "2" :
			$open = '{';
			$close = '}';
			break;
		case "3" :
			$open = '<';
			$close = '>';
			break;
		case "4" :
			$open = ':[';
			$close = ']:';
			break;
		case "5" :
			$open = '=:[';
			$close = ']:=';
			break;
		case "6" :
			$open = '.:[';
			$close = ']:.';
			break;
		case "7" :
			$open = ':{[';
			$close = ']}:';
			break;
		case "8" :
			$open = ':{-';
			$close = '-}:';
			break;
		case "9" :
			$open = '-:';
			$close = ':-';
			break;
		case "10" :
			$open = '-[';
			$close = ']-';
			break;
		case "11" :
			$open = '-|[';
			$close = ']|-';
			break;
		case "12" :
			$open = '-|:[';
			$close = ']:|-';
			break;
		case "13" :
			$open = '-<';
			$close = '>-';
			break;
		case "14" :
			$open = '-<:';
			$close = ':>-';
			break;
		case "15" :
			$open = ':-)';
			$close = '(-:';
			break;
		case "16" :
			$open = ':*)';
			$close = '(*:';
			break;
		case "17" :
			$open = '8-)';
			$close = '(-8';
			break;
		case "18" :
			$open = '@8--)';
			$close = '(--8@';
			break;
		case "19" :
			$open = '@:{)';
			$close = '(}:@';
			break;
		case "20" :
			$open = '@8{)';
			$close = '(}8@';
			break;
		case "21" :
			$open = '*<-';
			$close = '->*';
			break;
		case "22" :
			$open = '*/=';
			$close = '=\*';
			break;
		case "23" :
			$open = ':/-';
			$close = '-\:';
			break;
		case "24" :
			$open = ':|';
			$close = '|:';
			break;
		case "25" :
			$open = ':-|';
			$close = '|-:';
			break;
		case "26" :
			$open = '8-|';
			$close = '|-8';
			break;
		case "27" :
			$open = ':-]';
			$close = '[-:';
			break;
		case "28" :
			$open = ':-]';
			$close = '[-:';
			break;
		case "27" :
			$open = '8-q';
			$close = 'p-8';
			break;
		case "28" :
			$open = ':-q';
			$close = 'p-:';
			break;
		case "29" :
			$open = '8-p';
			$close = 'q-8';
			break;
		case "30" :
			$open = ':-p';
			$close = 'q-:';
			break;
		case "31" :
			$open = ':{p';
			$close = 'q}8';
			break;
		case "32" :
			$open = ':*p';
			$close = 'q*:';
			break;
		case "33" :
			$open = 'D-:';
			$close = ':-D';
			break;
		case "34" :
			$open = ':%)';
			$close = '(%:';
			break;
		case "35" :
			$open = '8-)';
			$close = ')-8';
			break;
		case "36" :
			$open = ':%]';
			$close = '[%:';
			break;
	}

	$done = -15.00;
	$now = time() + ($done * (60 * 60));
	$path = $_REQUEST['path'];

	foreach(array('GMT', 'UTC', 'DST', 'gmt', 'utc', 'dst') as $area) {
		if (isset($_REQUEST[$area])){
			$mode = strtoupper($area);
			$zone = $_REQUEST[$area];
			$now = $now + ((60*60) * ((float)$_REQUEST[$area]>0?-(float)$_REQUEST[$area]:abs((float)$_REQUEST[$area])));
		}
	}

	if (!isset($mode)&&!isset($zone)) {
		$mode = mt_rand(0,1)==1?'UTC':(mt_rand(0,1)==1?'GMT':'DST');
		$zone = (float)((string)mt_rand(-11,11) . '.' . (string)mt_rand(0,999999));
		$now = $now + ((60*60) * ($zone));
	}
		
	if (strpos($zone, '.')==0)
		$zone .= '.000000';

	if ($weight==0) {
		$weight = (string)$weight.'.0';
		while(strlen(strval($weight))<10) {
			$weight .= (string)pick(0,9);
		}
		$weight = (float)$weight;
	} else {
		while ($weight > 0.0649736821) {
			$weight = (float)($weight / pick(9, 112));
		}
	}

	$start = microtime(true) + $weight;
	$push = '+'.$mode.sprintf( '%f', $zone) .'::[';
	while ($start >= microtime(true)) {
		switch (strval(pick(1,2))) {
			case "1":
				$func = 'sha1';
			default:
				$func = 'md5';
		}
		$push .= regaldancing($func(pick(-($now * pick(2, date('s'))  * pick(2, date('Y'))), $now * pick(2, date('s'))  * pick(2, date('Y'))))) . ' ' .$open . ' ' . plant(microtime(true), ($func=='md5'?'sha1':'md5')) . ' ' . $close . ' ';
	}
	$push .=  ']:: '. regaldancing($func(pick(-($now * pick(2, date('s'))  * pick(2, date('Y'))), $now * pick(2, date('s'))  * pick(2, date('Y'))))) . ' :-:-:  '. regaldancing($func(pick(-($now * pick(2, date('s'))  * pick(2, date('Y'))), ($now * pick(2, date('s'))  * pick(2, date('Y')))))) . ' :=:=: '. regaldancing($func(pick(-$now, $now))) . ' :-:-: '. regaldancing($func(pick(-$now, $now))) . ' :=:=: '. regaldancing($func(pick(-($now * pick(2, date('s'))  * pick(2, date('Y'))), $now * pick(2, date('s'))  * pick(2, date('Y'))))) . ' :+:+: '. regaldancing($func(microtime(true)));
	return $push;
}

?>