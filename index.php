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
 * @version         $Id: index.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		randomisation
 * @description		Random Seeding Feed Token Generator
 */

error_reporting(E_ERROR);
ini_set('display_error', true);
header( "Content-type: application/rss+xml" );
include_once(dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'public_html'.DIRECTORY_SEPARATOR.'mainfile.php');
include_once(dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'public_html'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'xoopscache.php');
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'functions.php');
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'getsum.php');

$domain = strpos($_SERVER["HTTP_HOST"], "ringwould.com.au")>0?"ringwould.com.au":"labs.coop";
$business = strpos($_SERVER["HTTP_HOST"], "ringwould.com.au")>0?"Ringwould Farm (Australia)":"Chronolabs Cooperative";	
$email = strpos($_SERVER["HTTP_HOST"], "ringwould.com.au")>0?"ringwould@me.com":"leshy@slams.io";

ini_set('display_error', true);
error_reporting(E_ERROR);

/**
 * @var string		GMT/UTC/DST Server Weight to 0.00 Variable
 */
$done = -4.00;


/**
 * @var string		Current UNIX Date/time stamp for GMT+0
 */
$now = time() + ($done * (60 * 60));

/**
 * @var string		Execution Path
 */
$path = $_REQUEST['path'];

foreach(array('GMT', 'UTC', 'DST', 'gmt', 'utc', 'dst') as $area) {
	if (isset($_REQUEST[$area])){

		/**
		 * @var string		Timezone Mode
		 */
		$mode = strtoupper($area);
		
		/**
		 * @var string		Timezone
		 */
		$zone = $_REQUEST[$area];

		/**
		 * @var string		Current Timezone Unix Time Stamp
		 */
		$now = $now + ((60*60) * ((float)$_REQUEST[$area]>0?-(float)$_REQUEST[$area]:abs((float)$_REQUEST[$area])));
	}
}

if (!isset($mode)&&!isset($zone)) {

	/**
	 * @var string		Random Timezone Mode
	 */
	$mode = mt_rand(0,1)==1?'UTC':(mt_rand(0,1)==1?'GMT':'DST');
	

	/**
	 * @var string		Random Timezone
	 */
	$zone = (float)((string)mt_rand(-11,11) . '.' . (string)mt_rand(0,999999));

	/**
	 * @var string		Current Timezone Unix Time Stamp
	 */
	$now = $now + ((60*60) * ($zone));
}

if (strpos($zone, '.')==0)
	$zone .= '.000000';
	
switch(pick(0,3)) {
case "0" : 
	
	/**
	 * @var string		Checksum for Function A
	 */
	$funca = 'md5';
	
	/**
	 * @var string		Checksum for Function B
	 */
	$funcb = 'sha1';
	
	break;
case "1" :  
	
	/**
	 * @var string		Checksum for Function A
	 */
	$funca = 'sha1';
	
	/**
	 * @var string		Checksum for Function B
	 */
	$funcb = 'md5';
	
	break;
case "2" :  
	
	/**
	 * @var string		Checksum for Function A
	 */
	$funca = 'md5';

	/**
	 * @var string		Checksum for Function B
	 */
	$funcb = 'md5';
	
	break;
case "3" :

	/**
	 * @var string		Checksum for Function A
	 */
	$funca = 'sha1';

	/**
	 * @var string		Checksum for Function B
	 */
	$funcb = 'sha1';
	
	break;
}


/**
 * @var string		Number of randomisation seed tokens to output
 */
$num = isset($_REQUEST['num'])&&intval($_REQUEST['num'])>=5?intval($_REQUEST['num']):pick(6,19);

/**
 * @var string		Randomisation Seed
 */
$espacey = isset($_REQUEST['seed'])&&strlen($_REQUEST['seed'])>=pick(2,10)?(string)($_REQUEST['seed']):pick(pick(222,8122392), 10);

/**
 * @var string		RSS Feed Array
 */
//if(!$content = XoopsCache::read('seed_'.$mode.'_'.date('h').'_'.md5($_SERVER['REQUEST_URI']))) {;
	$v = 0;
	$content['feed'][++$v] = '<?xml version="1.0"?>';
	$content['feed'][++$v] = '<rss version="2.0">'; 
	$content['feed'][++$v] = chr(9).'<channel>'; 
	$content['feed'][++$v] = chr(9).chr(9).'<title>'.$business.' Seeder</title>'; 
	$content['feed'][++$v] = chr(9).chr(9).'<description>This feed can be used to derive an actual seed for random selection of any computing system, world-wide. Number of choices of seed to take from in this data impression is '. $num .'</description>'; 
	$content['feed'][++$v] = chr(9).chr(9).'<link>http://'.$domain.'</link>';
	$content['feed'][++$v] = chr(9).chr(9).'<lastBuildDate>'. gmdate('D, d M Y H:i:s', time()) . '</lastBuildDate>';
	$content['feed'][++$v] = chr(9).chr(9).'<docs>http://backend.userland.com/rss/</docs>';
	$content['feed'][++$v] = chr(9).chr(9).'<generator>http://'.$domain . '</generator>';
	$content['feed'][++$v] = chr(9).chr(9).'<managingEditor>leshy@slams.io</managingEditor>';
	$content['feed'][++$v] = chr(9).chr(9).'<webMaster>'.$email.'</webMaster>';
	$content['feed'][++$v] = chr(9).chr(9).'<language>en</language>';
	$content['feed'][++$v] = chr(9).chr(9).'<category>Centroidal Relationships</category>';
	$content['feed'][++$v] = chr(9).chr(9).'<image>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<title>'.$business.'</title>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<url>https://icons.ringwould.com.au/trusting/apple-touch-icon-114x114.png</url>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<link>'.$domain.'</link>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<width>128</width>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<height>128</height>';
	$content['feed'][++$v] = chr(9).chr(9).'</image>';

	for($u=1;$u<$num;$u++) {
		$content['feed'][++$v] = '';
		$espacey = cipherism(0, 10.00);
		$token = regaldancing($funca($espacey));

		$content['feed'][++$v] = chr(9).chr(9).'<item>'; 
		$content['feed'][++$v] = chr(9).chr(9).chr(9).'<title>Token '. $u .': '. $token . '</title>'; 
		$content['feed'][++$v] = chr(9).chr(9).chr(9).'<description>'. str_replace('&#', '&#', htmlspecialchars($espacey)) . '</description>'; 
		$content['feed'][++$v] = chr(9).chr(9).chr(9).'<category>Seeds Token</category>';
		$content['feed'][++$v] = chr(9).chr(9).chr(9).'<pubDate>'. gmdate('D, d M Y H:i:s', time()) . '</pubDate>';
		$content['feed'][++$v] = chr(9).chr(9).chr(9).'<link>' . XOOPS_PROT . 'seed.feeds.labs.coop/'. $mode . '/'. $zone . '/'. $token .'/'. $num .'</link>';
		$content['feed'][++$v] = chr(9).chr(9).chr(9).'<guid>'. regaldancing(hashinfo($espacey.$u)) . '</guid>';
		$content['feed'][++$v] = chr(9).chr(9).'</item>'; 
	}
	$content['feed'][++$v] = '';
	$content['feed'][++$v] = chr(9).chr(9).'<item>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<title>Specify Timezone Mode GMT/UTC!</title>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<description>'.htmlspecialchars('Current mode is: <strong>'.$mode.'</strong>. You can input a decimal gmt now by changing it on the end of the url, the name of the element to use on the URL is <strong>gmt</strong> for example this url at the moment as default would be <a hpick="http://seed.feeds.labs.coop/?gmt='.$zone.'">http://seed.feeds.labs.coop/?gmt='.$zone.'</a><br/><br/>All you have to do is change the symbol on the end remember that the earth is a circular motion through -12 to 12 - all numeric and will react to remainder (no more no less). So if you want to change the URL the gmt part you would be changine for revolutionary area of the time and this is currently set to <strong>'.$zone.'</strong><br/><br/>For example if you wanted to have a list of sydney australia\'s time seeds you would specify a <strong>GMT</strong> of <strong>10</strong> - This would look like on the URL as <a hpick="http://seed.feeds.labs.coop/GMT/10.00">http://seed.feeds.labs.coop/GMT/10.00</a>.<br/><br/>').htmlspecialchars('You can input a decimal utc now by changing it on the end of the url, the name of the element to use on the URL is <strong>utc</strong> for example this url at the moment as default would be <a hpick="http://seed.feeds.labs.coop/?utc='.$zone.'">http://seed.feeds.labs.coop/?utc='.$zone.'</a><br/><br/>All you have to do is change the symbol on the end remember that the earth is a circular motion through -12 to 12 - all numeric and will react to remainder (no more no less). So if you want to change the URL the utc part you would be changine for revolutionary area of the time and this is currently set to <strong>'.$zone.'</strong><br/><br/>For example if you wanted to have a list of sydney australia\'s time you would specify a <strong>utc</strong> of <strong>10</strong> - This would look like on the URL as <a hpick="http://seed.feeds.labs.coop/UTC/10.00">http://seed.feeds.labs.coop/UTC/10.00</a>.<br/><br/>You will find some help articles like the one\'s on <a href="http://simonaroberts.com/mynamesnot/laboratory/2013/12/using-dom-to-seed-your-randomisation-in-php/">simonaroberts.com</a> on methods of using this feed API.<br/><br/><em><strong>This feed is also available via SSL Securely at <a href="https://seed.labs.coop">https://seed.labs.coop</a><strong></em><br/><br/><em>Have you tried any of our other tickers like</em> <a href="http://time.feeds.labs.coop/GMT/0.00">Time</a> or <a href="http://spline.feeds.labs.coop/">GeoSpatial Spline</a>?').'</description>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<category>Help</category>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<pubDate>'.gmdate('D, d M Y H:i:s', time()).'</pubDate>';
	$content['feed'][++$v] = chr(9).chr(9).chr(9).'<guid>'.regaldancing(sha1('Specify Timezone Mode!')).'</guid>';
	$content['feed'][++$v] = chr(9).chr(9).'</item>';		

	$content['feed'][++$v] = chr(9).'</channel>'; 
	$content['feed'][++$v] = '</rss>';
	
	mt_srand(implode("\n", $content['feed']));
	
	//XoopsCache::write('seed_'.$mode.'_'.date('h').'_'.md5($_SERVER['REQUEST_URI']), $content, mt_rand(900, 3600));
	unlink(dirname(__FILE__).DIRECTORY_SEPARATOR.'508.shtml');
	$f = fopen(dirname(__FILE__).DIRECTORY_SEPARATOR.'508.shtml', 'w');
	fwrite($f, implode("\n", $content['feed']), strlen(implode("\n", $content['feed'])));
	fclose($f);
	
	unlink(dirname(__FILE__).DIRECTORY_SEPARATOR.'503.shtml');
	$f = fopen(dirname(__FILE__).DIRECTORY_SEPARATOR.'503.shtml', 'w');
	fwrite($f, implode("\n", $content['feed']), strlen(implode("\n", $content['feed'])));
	fclose($f);
//}
header( "Content-type: text/xml; charset=UTF-8" );
header( "Context-referrer: ".sha1(gethostbyaddr($_SERVER['REMOTE_ADDR']).strval(microtime(true)).$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['REMOTE_ADDR'].$_SERVER['QUERY_STRING'].$_SERVER['HTTP_USER_AGENT']) );
echo implode("\n", $content['feed']);
exit(0);
?>
