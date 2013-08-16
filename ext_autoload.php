<?php

if(version_compare(TYPO3_version, '6', '<')) {
    $path = t3lib_extMgm::extPath('pagenotfoundhandling');
} else {
    $path = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('pagenotfoundhandling');
}
return array(
    'Aaw\\Pagenotfoundhandling\\Utility\\Typo3versionUtility' => $path . 'Classes/Utility/Typo3version.php',
    'Aaw\\Pagenotfoundhandling\\Utility\\LanguageSelectUtility' => $path . 'Classes/Utility/LanguageSelect.php',
    'AAW\\Pagenotfoundhandling\\Controller\\PagenotfoundhandlingController' => $path . 'Classes/Controller/Pagenotfoundhandling.php',
);
?>