<?php
/*
 # MediaWiki 'glamdrol' style sheet
 # Copyright (C) 2005 by Jordà Polo <jorda AT ettin DOT org>
 #
 # Based on 'monobook', by Gabriel Wicke
 #
 # This style sheet is free software; you can redistribute it and/or
 # modify under the terms of the GNU General Public License as
 # published by the Free Software Foundation; either version 2 of the
 # License, or (at your option) any later version.
 #
 # This style sheet is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY.
 #
 # See <http://www.gnu.org/copyleft/gpl.html> for more details.
 */

if(!defined('MEDIAWIKI')) die();

require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 */
class SkinGlamdrol extends SkinTemplate {
	function initPage( &$out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'glamdrol';
		$this->stylename = 'glamdrol';
		$this->template  = 'GlamdrolTemplate';
	}
}
	
class GlamdrolTemplate extends QuickTemplate {
	/**
	 * Template filter callback for Glamdrol skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	function execute() {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>

<meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
<?php $this->html('headlinks') ?>
<link rel="stylesheet" type="text/css" media="print" href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
<link rel="shortcut icon" type="image/png" href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/ico.png" />

<style type="text/css" media="screen,projection">/*<![CDATA[*/ @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css"; /*]]>*/</style>
<?php if($this->data['jsvarurl']) { ?><script type="text/javascript" src="<?php $this->text('jsvarurl') ?>"></script><?php } ?>
<script type="text/javascript" src="<?php $this->text('stylepath') ?>/common/wikibits.js"></script>

<title><?php $this->text('pagetitle') ?></title>

<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1872754-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>


<body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?><?php if(isset($this->data['nsclass']))
{ ?>class="<?php $this->text('nsclass') ?>"<?php } ?>>

<div id="global">

<div id="header">
  <div id="logo">
    <a href="http://www.wesnoth.org/"><img alt="Wesnoth logo" src="<?php $this->text('stylepath') ?>/glamdrol/wesnoth-logo.jpg" /></a>
  </div>
</div>

<div id="nav">
  <ul>
    <li><a href="http://www.wesnoth.org/">Home</a></li>
    <li><a href="http://wiki.wesnoth.org/Play">Play</a></li>
    <li><a href="http://wiki.wesnoth.org/Create">Create</a></li>
    <li><a href="http://forums.wesnoth.org/">Forums</a></li>
    <li><a href="http://wiki.wesnoth.org/Support">Support</a></li>
    <li><a href="http://wiki.wesnoth.org/Project">Project</a></li>
    <li><a href="http://wiki.wesnoth.org/Credits">Credits</a></li>
    <li><a href="http://wiki.wesnoth.org/UsefulLinks">Links</a></li>
  </ul>
</div>

<div id="main">
<!-- Google AdSense -->
<script type="text/javascript"><!--
google_ad_client = "pub-0517361381516880";
/* 728x90, created 7/8/08 */
google_ad_slot = "2533616207";
google_ad_width = 728;
google_ad_height = 90;
google_color_border = "FFFFFF";
google_color_bg = "FFFBF7";
google_color_link = "0000FF";
google_color_text = "000000";
google_color_url = "008000";
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<!-- End Google AdSense -->

<div id="content">
  <a name="top" id="contentTop"></a>
  <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
  <h1 class="firstHeading"><?php $this->text('title') ?></h1>
  <div id="bodyContent">
    <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
    <div id="contentSub"><?php $this->html('subtitle') ?></div>
    <?php if($this->data['undelete']) { ?><div id="contentSub"><?php     $this->html('undelete') ?></div><?php } ?>
    <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>

    <!-- start wikipage -->
    <?php $this->html('bodytext') ?>
    <?php if($this->data['catlinks']) { ?><div id="catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>
    <!-- end wikipage -->

    <?php if($this->data['lastmod'   ]) { ?><div id="lastmod"><?php    $this->html('lastmod')    ?></div><?php } ?>
    <div class="visualClear"></div>
  </div>
</div> <!-- end content -->

<div id="footer">

  <?php if($_SESSION['wsUserID']) { ?>

  <div class="portlet" id="p-cactions">
    <ul>
    <?php foreach($this->data['content_actions'] as $key => $action) { ?>
      <li id="ca-<?php echo htmlspecialchars($key) ?>"<?php if($action['class']) { ?> class="<?php echo htmlspecialchars($action['class']) ?>"<?php } ?>>
      <a href="<?php echo htmlspecialchars($action['href']) ?>"><?php echo htmlspecialchars($action['text']) ?></a>
      </li>
    <?php } ?>
    </ul>
  </div>

  <div class="portlet" id="p-tb">
    <ul>
      <?php if($this->data['notspecialpage']) { foreach( array( 'whatlinkshere', 'recentchangeslinked' ) as $special ) { ?>
      <li id="t-<?php echo $special?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href']) ?>"><?php echo $this->msg($special) ?></a></li>
      <?php } } ?>
      <?php if($this->data['feeds']) { ?><li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) { ?><span id="feed-<?php echo htmlspecialchars($key) ?>"><a href="<?php echo htmlspecialchars($feed['href']) ?>"><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span><?php } ?></li><?php } ?>
      <?php foreach( array('contributions', 'emailuser', 'upload', 'specialpages') as $special ) { ?> <?php if($this->data['nav_urls'][$special]) {?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href']) ?>"><?php $this->msg($special) ?></a></li><?php } ?>
      <?php } ?>
    </ul>
  </div>

  <? } /* end if */ ?>

<div class="visualClear"></div>

  <div class="portlet" id="p-personal">
      <ul>
      <?php foreach($this->data['personal_urls'] as $key => $item) { ?>
        <li id="pt-<?php echo htmlspecialchars($key) ?>">
        <a href="<?php echo htmlspecialchars($item['href']) ?>"<?php if(!empty($item['class'])) { ?> class="<?php echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php echo htmlspecialchars($item['text']) ?></a>
        </li>
      <?php } ?>
      </ul>
  </div>

  <div class="portlet" id="p-fixed">
    <ul>
      <li><a href="http://www.wesnoth.org/">Home</a></li>
      <li><a href="/wiki/Special:Recentchanges">Recent changes</a></li>
      <li><a href="/wiki/Special:Search">Search</a></li>
    </ul>
  </div>

<div class="visualClear"></div>

  <div id="note">
    <p><a href="http://www.wesnoth.org/wiki/Wesnoth:Copyrights">Copyright</a> &copy; 2003-2013 The Battle for Wesnoth</p>
    <p>Powered by <a href="http://www.mediawiki.org/">MediaWiki</a></p>
  </div>

</div> <!-- end footer -->

</div> <!-- end main -->

</div> <!-- end global -->

<?php $this->html('reporttime') ?>

</body>
</html>
<?php
	}
}

/* search form */
/*
<!--
<div id="p-search" class="portlet">
  <div class="pBody">
    <form name="searchform" action="<?php $this->text('searchaction') ?>" id="searchform">
      <input id="searchInput" name="search" type="text" <?php if($this->haveMsg('accesskey-search')) { ?>accesskey="<?php $this->msg('accesskey-search') ?>"<?php } if( isset( $this->data['search'] ) ) { ?> value="<?php $this->text('search') ?>"<?php } ?> />
      <input type='submit' name="go" class="searchButton" id="searchGoButton" value="<?php $this->msg('go') ?>" />&nbsp;<input type='submit' name="fulltext" class="searchButton" value="<?php $this->msg('search') ?>" />
    </form>
  </div>
</div>
-->
*/

?>
