<?php

/**********************************************************
    SpamRegexByGroup
    Allow different Spam Blacklists per Group
    Author: Philipp Gruber <philipp.gruber@flupps.net>
 **********************************************************/

$wgExtensionCredits['antispam'][] = array(
    'path' => __FILE__,
    'name' => 'SpamRegexByGroup',
    'author' => 'Philipp Gruber', 
    'url' => '', 
    'description' => 'Define different spamRegex values per group',
    'version'  => '1.0',
);

$wgHooks['ArticleSave'][] = 'efSpamRegexByGroup';

function efSpamRegexByGroup(&$article, &$user, &$text, &$summary, $minor, $watch, $sectionanchor, &$flags) {
    global $wgSpamRegexGroup;

    if (!isset($wgSpamRegexGroup) || !is_array($wgSpamRegexGroup))
        return true;

    $uregex = false;

    foreach ($wgSpamRegexGroup AS $group => $regex) {
        if (in_array($group, $user->mEffectiveGroups))
            $uregex = $regex;
    }

    if ($uregex)
        if (preg_match($uregex, $text))
            return false;

    return true;
}

?>
