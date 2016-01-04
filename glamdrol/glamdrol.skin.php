<?php
/*
 * MediaWiki 'glamdrol' style sheet
 * Copyright (C) 2005 by Jordà Polo <jorda AT ettin DOT org>
 * Copyright (C) 2014 - 2015 by Ignacio R. Morelle <shadowm@wesnoth.org>
 *
 * Based on 'monobook', by Gabriel Wicke
 *
 * This style sheet is free software; you can redistribute it and/or
 * modify under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * This style sheet is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY.
 *
 * See <http://www.gnu.org/copyleft/gpl.html> for more details.
 */

if (!defined('MEDIAWIKI'))
{
	die(-1);
}

/**
 * SkinTemplate class for Glamdrol skin
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @ingroup Skins
 */
class SkinGlamdrol extends SkinTemplate
{
	var $skinname = 'glamdrol',
		$stylename = 'glamdrol',
		$template = 'GlamdrolTemplate',
		$useHeadElement = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage(OutputPage $out)
	{
		global $wgLocalStylePath;

		parent::initPage($out);

		$out->addHeadItem('favicon',
			'<link rel="shortcut icon" type="image/png" href="' .
			htmlspecialchars( $wgLocalStylePath ) . '/' . $this->stylename .
			'/ico.png" />'
		);
		$out->addHeadItem('ga',
			'<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-1872754-3"]);
  _gaq.push(["_trackPageview"]);

  (function() {
    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>'
		);
	}

	/**
	 * Loads skin and user CSS files.
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss(OutputPage $out)
	{
		parent::setupSkinUserCss($out);

		//wfRunHooks('SkinGlamdrolStyleModules', array(&$this, &$styles));
		$out->addModuleStyles('skins.glamdrol');
	}
}

/**
 * BaseTemplate class for Glamdrol skin
 * @ingroup Skins
 */
class GlamdrolTemplate extends BaseTemplate
{

	/**
	 * Outputs the entire contents of the (X)HTML page
	 */
	public function execute()
	{
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		// Output HTML Page
		$this->html('headelement');
?>

<div id="global">

<div id="header">
	<div id="logo">
		<a href="//www.wesnoth.org/"><img alt="Wesnoth logo" src="<?php $this->text('stylepath') ?>/glamdrol/wesnoth-logo.jpg" /></a>
	</div>
</div>

<div id="nav">
	<ul>
		<li><a href="//www.wesnoth.org/">Home</a></li>
		<li><a href="//wiki.wesnoth.org/Play">Play</a></li>
		<li><a href="//wiki.wesnoth.org/Create">Create</a></li>
		<li><a href="//forums.wesnoth.org/">Forums</a></li>
		<li><a href="//wiki.wesnoth.org/Support">Support</a></li>
		<li><a href="//wiki.wesnoth.org/Project">Project</a></li>
		<li><a href="//wiki.wesnoth.org/Credits">Credits</a></li>
		<li><a href="//wiki.wesnoth.org/UsefulLinks">Links</a></li>
	</ul>
</div>

<div id="main">

<div id="content" role="main">
	<a name="top" id="contentTop"></a>
	<?php if ($this->data['sitenotice']) { ?>
		<div id="siteNotice" class="usermessage sitenotice">
			<?php $this->html('sitenotice') ?>
		</div>
	<?php } ?>

	<h1 class="firstHeading" lang="<?php
		$this->data['pageLanguage'] = $this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();
		$this->text('pageLanguage');
	?>"><?php $this->html('title') ?></h1>

	<div id="bodyContent">
		<?php if ($this->data['isarticle']) { ?>
			<div id="siteSub"><?php $this->msg('tagline') ?></div>
		<?php } ?>
		<div id="contentSub"><?php $this->html('subtitle') ?></div>
		<?php if ($this->data['undelete']) { ?>
			<div id="contentSub2"><?php $this->html('undelete') ?></div>
		<?php } ?>
		<?php if ($this->data['newtalk']) { ?>
			<div class="usermessage"><?php $this->html('newtalk') ?></div>
		<?php } ?>

		<!-- start wikipage -->
		<?php $this->html('bodycontent') ?>
		<?php if ($this->data['printfooter']) { ?>
			<div class="printfooter"><?php $this->html( 'printfooter' ); ?></div>
		<?php } ?>
		<?php if ($this->data['catlinks']) { ?>
			<?php $this->html('catlinks'); ?>
		<?php } ?>
		<!-- end wikipage -->

		<?php if ($this->data['lastmod']) { ?>
			<div id="lastmod"><?php $this->html( 'lastmod' ); ?></div>
		<?php } ?>
		<?php if ($this->data['dataAfterContent']) { ?>
			<?php $this->html('dataAfterContent'); ?>
		<?php } ?>
		<div class="visualClear"></div>
		<?php $this->html('debughtml'); ?>
	</div>
</div> <!-- end content -->

<div id="footer" role="contentinfo">

	<?php if ($_SESSION['wsUserID']) { ?>

	<div class="portlet" id="p-cactions" role="navigation">
		<ul><?php
			foreach ($this->data['content_actions'] as $key => $tab)
			{
				echo $this->makeListItem($key, $tab);
			}
		?></ul>
	</div>

	<div class="portlet" id="p-tb" role="navigation">
		<ul><?php
			if ($this->data['notspecialpage'])
			{
				foreach (array('whatlinkshere', 'recentchangeslinked') as $special)
				{
					echo $this->makeListItem($special, $this->data['nav_urls'][$special]);
				}
			}

			if ($this->data['feeds'])
			{
				foreach ($this->data['feeds'] as $key => $feed)
				{
					echo $this->makeListItem($key, $feed);
				}
			}

			foreach (array('contributions', 'emailuser', 'upload', 'specialpages') as $special)
			{
				if ($this->data['nav_urls'][$special])
				{
					echo $this->makeListItem($special, $this->data['nav_urls'][$special]);
				}
			}

			//wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this, true ) );
		?></ul>
	</div>

	<?php } /* end if ($_SESSION['wsUserID']) */ ?>

	<div class="visualClear"></div>

	<div class="portlet" id="p-personal" role="navigation">
		<ul<?php $this->html('userlangattributes') ?>><?php
		foreach ($this->getPersonalTools() as $key => $item)
		{
			echo $this->makeListItem($key, $item);
		}
		?></ul>
	</div>

	<div class="portlet" id="p-fixed" role="navigation">
		<ul>
			<li><a href="//www.wesnoth.org/">Home</a></li>
			<li><a href="//wiki.wesnoth.org/Special:Recentchanges">Recent changes</a></li>
			<li><a href="//wiki.wesnoth.org/Special:Search">Search</a></li>
		</ul>
	</div>

	<div class="visualClear"></div>

	<div id="note" role="contentinfo">
		<p><a href="//wiki.wesnoth.org/Wesnoth:Copyrights">Copyright</a> &copy; 2003&#8211;2016 The Battle for Wesnoth</p>
		<p>Powered by <a href="http://www.mediawiki.org/">MediaWiki</a></p>
	</div>

</div> <!-- end footer -->

</div> <!-- end main -->

</div> <!-- end global -->

<?php
		$this->printTrail();
		echo Html::closeElement('body');
		echo Html::closeElement('html');
		wfRestoreWarnings();
	}
}
