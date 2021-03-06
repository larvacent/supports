<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports;

use HTMLPurifier_Config;

/**
 * Class HtmlPurifier
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class HtmlPurifier
{
    /**
     * @param string $string
     *
     * @return string
     */
    public static function cleanUtf8(string $string): string
    {
        return \HTMLPurifier_Encoder::cleanUTF8($string);
    }

    /**
     * @param string              $string
     * @param HTMLPurifier_Config $config
     *
     * @return string
     */
    public static function convertToUtf8(string $string, HTMLPurifier_Config $config): string
    {
        return \HTMLPurifier_Encoder::convertToUTF8($string, $config, null);
    }

    /**
     * configure
     *
     * @param HTMLPurifier_Config $config The config to use for HtmlPurifier.
     * @return void
     */
    public static function configure($config)
    {
        // Don't set alt attributes to filenames by default
        $config->set('Attr.DefaultImageAlt', '');
        $config->set('Attr.DefaultInvalidImageAlt', '');

        // Add support for some HTML5 elements
        // see http://htmlpurifier.org/phorum/read.php?3,6731,6731
        $config->set('HTML.DefinitionID', '1');
        // see https://github.com/mewebstudio/Purifier/issues/32#issuecomment-182502361
        // see https://gist.github.com/lluchs/3303693
        if ($def = $config->maybeGetRawHTMLDefinition()) {
            // Content model actually excludes several tags, not modelled here
            $def->addElement('address', 'Block', 'Flow', 'Common');
            $def->addElement('hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common');

            // http://developers.whatwg.org/grouping-content.html
            $def->addElement('figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common');
            $def->addElement('figcaption', 'Inline', 'Flow', 'Common');

            // http://developers.whatwg.org/text-level-semantics.html
            $def->addElement('s', 'Inline', 'Inline', 'Common');
            $def->addElement('var', 'Inline', 'Inline', 'Common');
            $def->addElement('sub', 'Inline', 'Inline', 'Common');
            $def->addElement('sup', 'Inline', 'Inline', 'Common');
            $def->addElement('mark', 'Inline', 'Inline', 'Common');
            $def->addElement('wbr', 'Inline', 'Empty', 'Core');

            // http://developers.whatwg.org/edits.html
            $def->addElement('ins', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']);
            $def->addElement('del', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']);
        }
    }
}