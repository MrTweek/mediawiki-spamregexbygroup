<?php

/**********************************************************
    SpamRegexByGroup
    Allow different Spam Blacklists per Group
 **********************************************************/

$wgExtensionCredits['antispam'][] = array(
    'path' => __FILE__,
    'name' => 'SpamRegexByGroup',
    'author' => 'Philipp Gruber', 
    'url' => '', 
    'description' => 'Define different spamRegex values per group',
    'version'  => 0.1,
);

$wgHooks['ArticleSave'][] = 'efSpamRegexByGroup';

function efSpamRegexByGroup(&$article, &$user, &$text, &$summary, $minor, $watch, $sectionanchor, &$flags) {
    file_put_contents('/tmp/srbp.log', print_r($user, true));;
    return false;
}

?>
