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
 * @version         $Id: getsum.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		randomisation
 * @description		Random Seeding Feed Token Generator
 */

/**
 * hashinfo()
 * Chooses a checksum to use based on options
 *
 * @param string $data			Data to be hashed
 * @param integer $opt			Optional Flag
 * @return string
 */
function hashinfo($data, $opt = -1) {
	if (pick(0,3)<1) {
		return md5($data);
	} else {
		return sha1($data);
	}
}
?>