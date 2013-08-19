<?php
namespace Aaw\Pagenotfoundhandling\Utility;
use \TYPO3\CMS\Core\Utility as TYPO3Utility;
/**
 * **************************************************************
 * Copyright notice
 *
 * (c) 2013 Agentur am Wasser | Maeder & Partner AG
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
 * @copyright  Copyright (c) 2013 Agentur am Wasser | Maeder & Partner AG (http://www.agenturamwasser.ch)
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU General Public License
 * @category   TYPO3
 * @package    pagenotfoundhandling
 * @version    $Id$
 */

/**
 * TYPO3 version utility, that manages the calls to maybe changed TYPO3 API,
 * depending on the version of TYPO3
 *
 * @author   Agentur am Wasser | Maeder & Partner AG <development@agenturamwasser.ch>
 * @category TYPO3
 * @package  pagenotfoundhandling
 */
class Typo3versionUtility
{
    const VERSION_4_5 = 4005000;
    const VERSION_4_6 = 4006000;
    const VERSION_4_7 = 4007000;
    const VERSION_6_0 = 6000000;
    const VERSION_6_1 = 6001000;

    /**
     * @var integer
     */
    protected static $_version = null;

    /**
     * Internally creates an interger version from {@link TYPO3_version}
     *
     * @return void
     */
    protected static function _determineVersion()
    {
        if(self::$_version === null) {
            if(!class_exists('TYPO3\\CMS\\Core\\Utility\\VersionNumberUtility', false)) {
                self::$_version = \t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version);
            } else {
                self::$_version = TYPO3Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version);
            }
        }
    }

//     /**
//      * @see \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger() for TYPO3 >= 6.0
//      * @see t3lib_utility_Math::canBeInterpretedAsInteger() for TYPO3 < 6.0 and TYPO3 >= 4.6
//      * @see t3lib_div::testInt() for TYPO3 < 4.6
//      */
//     public static function canBeInterpretedAsInteger($var)
//     {
//         self::_determineVersion();
//         if(self::$_version < self::VERSION_4_6) {
//             return t3lib_div::testInt($var);
//         } elseif(self::$_version < self::VERSION_6_0) {
//             return t3lib_utility_Math::canBeInterpretedAsInteger($var);
//         }
//         return TYPO3Utility\MathUtility::canBeInterpretedAsInteger($var);
//     }

    /**
     * @see \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode() for TYPO3 >= 6.0
     * @see t3lib_div::trimExplode() for TYPO3 < 6.0
     */
    public static function trimExplode($delim, $string, $removeEmptyValues = FALSE, $limit = 0)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_div::trimExplode($delim, $string, $removeEmptyValues, $limit);
        }
        return TYPO3Utility\GeneralUtility::trimExplode($delim, $string, $removeEmptyValues, $limit);
    }

    /**
     * @see t3lib_div::_GET()
     * @see \TYPO3\CMS\Core\Utility\GeneralUtility::_GET()
     */
    public static function _GET($var = null)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_div::_GET($var);
        }
        return TYPO3Utility\GeneralUtility::_GET($var);
    }

    /**
     * @see t3lib_div::getIndpEnv()
     * @see \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv()
     */
    public static function getIndpEnv($getEnvName)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_div::getIndpEnv($getEnvName);
        }
        return TYPO3Utility\GeneralUtility::getIndpEnv($getEnvName);
    }

    /**
     * @see t3lib_div::locationHeaderUrl()
     * @see \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl()
     */
    public static function locationHeaderUrl($path)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_div::locationHeaderUrl($path);
        }
        return TYPO3Utility\GeneralUtility::locationHeaderUrl($path);
    }

    /**
     * @see t3lib_div::getURL()
     * @see \TYPO3\CMS\Core\Utility\GeneralUtility::getURL()
     */
    public static function getURL($url, $includeHeader = 0, $requestHeaders = FALSE, &$report = NULL)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_div::getURL($url, $includeHeader, $requestHeaders, $report);
        }
        return TYPO3Utility\GeneralUtility::getURL($url, $includeHeader, $requestHeaders, $report);
    }

    /**
     * @see t3lib_div::getFileAbsFileName()
     * @see \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName()
     */
    public static function getFileAbsFileName($filename, $onlyRelative = true, $relToTYPO3_mainDir = false)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_div::getFileAbsFileName($filename, $onlyRelative, $relToTYPO3_mainDir);
        }
        return TYPO3Utility\GeneralUtility::getFileAbsFileName($filename, $onlyRelative, $relToTYPO3_mainDir);
    }

    /**
     * @see t3lib_extMgm::extPath()
     * @see \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath()
     */
    public static function extPath($key, $script = '')
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_extMgm::extPath($key, $script);
        }
        return TYPO3Utility\ExtensionManagementUtility::extPath($key, $script);
    }

    /**
     * @see t3lib_extMgm::isLoaded()
     * @see \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded()
     */
    public static function isLoaded($key, $exitOnError = false)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_extMgm::isLoaded($key, $exitOnError);
        }

        return TYPO3Utility\ExtensionManagementUtility::isLoaded($key, $exitOnError);
    }

    /**
     * @see t3lib_extMgm::addTCAcolumns()
     * @see \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns()
     */
    public static function addTCAcolumns($table, $columnArray, $addTofeInterface = 0)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_extMgm::addTCAcolumns($table, $columnArray, $addTofeInterface);
        }

        return TYPO3Utility\ExtensionManagementUtility::addTCAcolumns($table, $columnArray, $addTofeInterface);
    }

    /**
     * @see t3lib_extMgm::addToAllTCAtypes()
     * @see \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes()
     */
    public static function addToAllTCAtypes($table, $str, $specificTypesList = '', $position = '')
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            return \t3lib_extMgm::addToAllTCAtypes($table, $str, $specificTypesList, $position);
        }

        return TYPO3Utility\ExtensionManagementUtility::addToAllTCAtypes($table, $str, $specificTypesList, $position);
    }

    /**
     * Returns an instance of either {@link language} or {@link \TYPO3\CMS\Lang\LanguageService}
     *
     * @return language | \TYPO3\CMS\Lang\LanguageService
     */
    public static function getLanguageInstance()
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            require_once PATH_typo3 . 'sysext/lang/lang.php';
            return \t3lib_div::makeInstance('language');
        }

        return TYPO3Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Lang\\LanguageService');
    }

    /**
     * Returns the value of the constant either from {@link t3lib_utility_Http)}
     * or {@link \TYPO3\CMS\Core\Utility\HttpUtility}
     *
     * @param string $name
     * @return string
     */
    public static function getHttpUtilityStatusHeaderConstant($name)
    {
        self::_determineVersion();
        if(self::$_version < self::VERSION_6_0) {
            $utilityClassName = '\\t3lib_utility_Http';
        } else {
            $utilityClassName = '\\TYPO3\\CMS\\Core\\Utility\\HttpUtility';
        }
        $utility = new \ReflectionClass($utilityClassName);
        $constants = $utility->getConstant($name);
        if(\array_key_exists($name, $constants)) {
            return $constants[$name];
        }
        return '';
    }
}

?>