<?php
/*
 * MediaWiki 'glamdrol' style sheet
 * Copyright (C) 2005 by Jordà Polo <jorda AT ettin DOT org>
 * Copyright (C) 2014 by Ignacio R. Morelle <shadowm@wesnoth.org>
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

$wgExtensionCredits['skin'][] = array(
	'path'			=> __FILE__,
	'name'			=> 'Glamdrol',
	'description'	=> 'The Battle for Wesnoth website theme',
	'version'		=> '1.2',
	'url'			=> 'http://www.wesnoth.org/',
	'author'		=> '[http://r.wesnoth.org/u7 Jordà Polo (ettin)], ' .
					   '[http://r.wesnoth.org/u104773 Ignacio R. Morelle (shadowm)]',
	'license'		=> 'GPL-2.0+',
);

$wgValidSkinNames['glamdrol'] = 'Glamdrol';
$wgAutoloadClasses['SkinGlamdrol'] = __DIR__ . '/glamdrol.skin.php';

$wgResourceModules['skins.glamdrol'] = array(
	'styles' => array(
		'glamdrol/main.css' => array('media' => 'screen'),
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);
