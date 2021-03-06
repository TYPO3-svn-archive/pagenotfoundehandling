<?php
/**
 * **************************************************************
 * Copyright notice
 *
 * (c) 2014 Agentur am Wasser | Maeder & Partner AG
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 * **************************************************************
 *
 * @author     Agentur am Wasser | Maeder & Partner AG <development@agenturamwasser.ch>
 * @copyright  Copyright (c) 2014 Agentur am Wasser | Maeder & Partner AG (http://www.agenturamwasser.ch)
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU General Public License
 * @category   TYPO3
 * @package    pagenotfoundhandling
 * @version    $Id$
 */

if (!defined ('TYPO3_MODE')) {
     die ('Access denied.');
}


$conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);

// add the fields to tca of sys_domain
if(!isset($conf['disableDomainConfig']) || empty($conf['disableDomainConfig'])) {

    $tempColumns = array (
        'tx_pagenotfoundhandling_enable' => array(
            'onChange' => 'reload',
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.enable',
            'config' => array (
                'type' => 'check',
                'default' => '0',
            )
        ),
        'tx_pagenotfoundhandling_default404Page' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.default404Page',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'wizards' => array(
                    'suggest' => array('type' => 'suggest')
                ),
            )
        ),
        'tx_pagenotfoundhandling_defaultTemplateFile' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.defaultTemplateFile',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => 'html,htm,tmpl,txt',
                'uploadfolder' => 'uploads/tx_pagenotfoundhandling',
                'show_thumbs' => 1,
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
            )
        ),
        'tx_pagenotfoundhandling_default403Page' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.default403Page',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'wizards' => array(
                    'suggest' => array('type' => 'suggest')
                ),
            )
        ),
        'tx_pagenotfoundhandling_default403Header' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.default403Header',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'select',
                'items' => array(
                    array('LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.default403Header.none', -1),
                    array('LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.default403Header.default', 0),
                    array('HTTP/1.1 400 Bad Request', 1),
                    array('HTTP/1.1 401 Unauthorized', 2),
                    array('HTTP/1.1 402 Payment Required', 3),
                    array('HTTP/1.1 403 Forbidden', 4),
                ),
                'size' => 1,
                'maxitems' => 1,
            )
        ),
        'tx_pagenotfoundhandling_ignoreLanguage' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.ignoreLanguage',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'check',
                'default' => '0',
            )
        ),
        'tx_pagenotfoundhandling_forceLanguage' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.forceLanguage',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'size' => 1,
                'autoSizeMax' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'allowed' => 'sys_language',
                'wizards' => array(
                    'suggest' => array('type' => 'suggest'),
                ),
            ),
        ),
        'tx_pagenotfoundhandling_languageParam' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.languageParam',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'input',
                'size' => '5',
                'default' => 'L',
            )
        ),
        'tx_pagenotfoundhandling_passthroughContentTypeHeader' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.passthroughContentTypeHeader',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'check',
                'default' => '0',
            )
        ),
        'tx_pagenotfoundhandling_additionalHeaders' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.additionalHeaders',
            'displayCond' => 'FIELD:tx_pagenotfoundhandling_enable:REQ:true',
            'config' => array (
                'type' => 'input',
                'default' => '',
            )
        ),
    );

    $GLOBALS['TCA']['sys_domain']['ctrl']['dividers2tabs'] = 1;
    if($GLOBALS['TCA']['sys_domain']['ctrl']['requestUpdate']) {
        $GLOBALS['TCA']['sys_domain']['ctrl']['requestUpdate'] .= ',tx_pagenotfoundhandling_enable';
    } else {
        $GLOBALS['TCA']['sys_domain']['ctrl']['requestUpdate'] = 'tx_pagenotfoundhandling_enable';
    }

    // creating palettes
    $GLOBALS['TCA']['sys_domain']['palettes']['tx_pagenotfoundhandling_404'] = array(
        'showitem' => 'tx_pagenotfoundhandling_default404Page,--linebreak--,tx_pagenotfoundhandling_defaultTemplateFile',
        'canNotCollapse' => 1
    );
    $GLOBALS['TCA']['sys_domain']['palettes']['tx_pagenotfoundhandling_403'] = array(
        'showitem' => 'tx_pagenotfoundhandling_default403Page,--linebreak--,tx_pagenotfoundhandling_default403Header',
        'canNotCollapse' => 1
    );
    $GLOBALS['TCA']['sys_domain']['palettes']['tx_pagenotfoundhandling_language'] = array(
        'showitem' => 'tx_pagenotfoundhandling_ignoreLanguage,tx_pagenotfoundhandling_forceLanguage,tx_pagenotfoundhandling_languageParam',
        'canNotCollapse' => 1
    );
    $GLOBALS['TCA']['sys_domain']['palettes']['tx_pagenotfoundhandling_options'] = array(
        'showitem' => 'tx_pagenotfoundhandling_passthroughContentTypeHeader',
        'canNotCollapse' => 1
    );

    t3lib_extMgm::addTCAcolumns('sys_domain', $tempColumns, 1);

    t3lib_extMgm::addToAllTCAtypes('sys_domain', '
        --div--;LLL:EXT:pagenotfoundhandling/locallang_db.xml:pagenotfoundhandling.sys_domain.tcasheet.title,
        tx_pagenotfoundhandling_enable;;;;1-1-1,
        tx_pagenotfoundhandling_default404Page;;;;1-1-1,
        tx_pagenotfoundhandling_defaultTemplateFile;;;;1-1-1,
        tx_pagenotfoundhandling_default403Page;;;;1-1-1,
        tx_pagenotfoundhandling_default403Header;;;;1-1-1,
        tx_pagenotfoundhandling_ignoreLanguage;;;;1-1-1,
        tx_pagenotfoundhandling_forceLanguage;;;;1-1-1,
        tx_pagenotfoundhandling_languageParam;;;;1-1-1,
        tx_pagenotfoundhandling_passthroughContentTypeHeader;;;;1-1-1,
        tx_pagenotfoundhandling_additionalHeaders;;;;1-1-1');
}

