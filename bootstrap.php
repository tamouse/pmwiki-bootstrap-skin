<?php if (!defined('PmWiki')) exit(); // -*- mode: php; time-stamp-start: "version [\"<]"; time-stamp-format: "%Y-%3b-%02d %02H:%02M"; -*- 
/**
 *
 * skin.php -- functions for mouse-skin pmwiki skin
 *
 * @author Tamara Temple <tamara@tamaratemple.com>
 * @since 2012-09-15
 * @version <2012-Sep-20 02:12>
 * @copyright (c) 2012 Tamara Temple Web Development
 * @license GPLv3
 *
 */

// Add a custom wikipage storage location for bundled pages.
global $WikiLibDirs;
$PageStorePath = (dirname(__FILE__))."/wikilib.d/\$FullName";
$where = count($WikiLibDirs);
if ($where>1) $where--;
array_splice($WikiLibDirs, $where, 0,
  array(new PageStore($PageStorePath)));

if (!isset($PageLogoUrl)) $PageLogoUrl = $SkinDirUrl.'/images/euphonium.gif';

global $FmtPV;
$FmtPV['$WikiTitle'] = '$GLOBALS["WikiTitle"]';
$FmtPV['$WikiTag'] = '$GLOBALS["WikiTag"]';
$FmtPV['$PageLogoUrl'] = '$GLOBALS["PageLogoUrl"]';
$FmtPV['$Skin'] = '$GLOBALS["Skin"]';
$FmtPV['$SkinColor'] = '$GLOBALS["SkinColor"]';

$DefaultSkinColor='white';
$AvailableSkinColors = array('white');

// see if the skin color theme has been given
if (isset($_REQUEST['SkinColor'])) {
  $SkinColor = strtolower($_REQUEST['SkinColor']);
  // save this color in a cookie
  setcookie('SkinColor',$SkinColor,mktime(0,0,0,1,1,(date("Y")+50))); // keep it for 50 years
}
elseif (isset($_COOKIES['SkinColor'])) {
  $SkinColor = $_COOKIES['SkinColor'];
}
elseif (!isset($SkinColor)) {
  $SkinColor = $DefaultSkinColor;
}
if (!in_array($SkinColor,$AvailableSkinColors)) {
  $MessagesFmt[] = "<div class='wikimessage'>Unknown skin color: ".htmlentities($SkinColor)."</div>";
  error_log(sprintf("[PmWiki] user error in file %s at line %s: Unknown skin color: %s\n",(basename(__FILE__)),__LINE__,$SkinColor));
  $SkinColor = $DefaultSkinColor;
}

// Thumbnails elements
Markup("bthumbnails", "inline", '/\\(:bthumbnails:\\)/',
  Keep('<ul class="thumbnails">'));
Markup("bthumbnailsend", "inline", '/\\(:bthumbnailsend:\\)/',
  Keep('</ul>'));
Markup("bthumb","inline",'/\\(:bthumb (\\d+):\\)/e',
  "Keep('<li class=\"span$1\"><div class=\"thumbnail\">')"");
Markup("bthumbend","inline",'/\\(:bthumbend:\\)/',
  Keep('</div></li>'));
