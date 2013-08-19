<?php

$path = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('pagenotfoundhandling');

return array(
    'Aaw\\Pagenotfoundhandling\\Utility\\LanguageSelectUtility' => $path . 'Classes/Utility/LanguageSelect.php',
    'AAW\\Pagenotfoundhandling\\Controller\\PagenotfoundhandlingController' => $path . 'Classes/Controller/Pagenotfoundhandling.php',
);
?>