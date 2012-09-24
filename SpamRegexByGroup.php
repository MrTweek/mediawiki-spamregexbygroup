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
    if (!isset($wgSpamRegexGroup) || !is_array($wgSpamRegexGroup))
        return true;

    $uregex = false;

    foreach ($wgSpamRegexGroup AS $group => $regex) {
        if (in_array($group, $user->mEffectiveGroups))
            $uregex = $regex;
    }

    file_put_contents('/tmp/srbp.log', $uregex);
   
    if ($uregex)
        if (preg_match($uregex, $text))
            return false;

    return true;
}

?>
