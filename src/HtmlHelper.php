<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports;


/**
 * Class HtmlHelper
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class HtmlHelper
{
    /**
     * Encodes special characters into HTML entities.
     * @param string $content the content to be encoded
     * @param bool $doubleEncode whether to encode HTML entities in `$content`. If false,
     * HTML entities in `$content` will not be further encoded.
     * @return string the encoded content
     * @see decode()
     * @see http://www.php.net/manual/en/function.htmlspecialchars.php
     */
    public static function encode($content, $doubleEncode = true)
    {
        return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', $doubleEncode);
    }

    /**
     * Decodes special HTML entities back to the corresponding characters.
     * This is the opposite of [[encode()]].
     * @param string $content the content to be decoded
     * @return string the decoded content
     * @see encode()
     * @see http://www.php.net/manual/en/function.htmlspecialchars-decode.php
     */
    public static function decode($content)
    {
        return htmlspecialchars_decode($content, ENT_QUOTES);
    }

    /**
     * Will take an HTML string and an associative array of key=>value pairs, HTML encode the values and swap them back
     * into the original string using the keys as tokens.
     *
     * @param string $html The HTML string.
     * @param array $variables An associative array of key => value pairs to be applied to the HTML string using `strtr`.
     * @return string The HTML string with the encoded variable values swapped in.
     */
    public static function encodeParams(string $html, array $variables = []): string
    {
        // Normalize the param keys
        $normalizedVariables = [];
        if (is_array($variables)) {
            foreach ($variables as $key => $value) {
                $key = '{' . trim($key, '{}') . '}';
                $normalizedVariables[$key] = static::encode($value);
            }
            $html = strtr($html, $normalizedVariables);
        }
        return $html;
    }

    /**
     * 检测 Html 编码
     * @param string $content
     * @return string
     */
    public static function getCharSet($content)
    {
        if (preg_match("/<meta.+?charset=[^\\w]?([-\\w]+)/i", $content, $match)) {
            return strtoupper($match [1]);
        } else { // 检测中文常用编码
            return strtoupper(mb_detect_encoding($content, ['ASCII', 'CP936', 'GB18030', 'UTF-8', 'BIG-5']));
        }
    }

    /**
     * 提取所有的 Head 标签返回一个数组
     * @param string $content
     * @return array
     */
    public static function getHeadTags($content)
    {
        $result = [];
        if (is_string($content) && !empty ($content)) {
            if (($chatSet = static::getCharSet($content)) != 'UTF-8') { // 转码
                $content = mb_convert_encoding($content, 'UTF-8', $chatSet);
            }
            if (preg_match("#<head[^>]*>(.*?)</head>#si", $content, $head)) {
                // 解析title
                if (preg_match('#<title[^>]*>([^>]*)</title>#si', $head [1], $match)) {
                    $result ['title'] = trim(strip_tags($match [1]));
                }
                // 解析meta
                if (preg_match_all('/<[\s]*meta[\s]*name="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $head [1], $match)) {
                    // name转小写
                    $names = array_map('strtolower', $match [1]);
                    $values = $match [2];
                    $nameTotal = count($names);
                    for ($i = 0; $i < $nameTotal; $i++) {
                        $result ['metaTags'] [$names [$i]] = $values [$i];
                    }
                }
                if (isset ($result ['metaTags'] ['keywords'])) {//将关键词切成数组
                    $keywords = str_replace(['，', '|', '、', ' '], ',', $result ['metaTags'] ['keywords']);
                    $result ['keywords'] = explode(',', $keywords);
                }
            }
        }
        return $result;
    }
}