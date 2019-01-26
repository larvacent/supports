<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports;


/**
 * SEO 助手
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class SEOHelper
{
    /**
     * @param string $site 网站
     * @param string $token Token
     * @param string|array $urls Url列表
     * @return mixed
     */
    public static function baiduPing($site, $token, $urls)
    {
        if (is_array($urls)) {
            $urls = implode("\n", $urls);
        }
        $client = new HttpClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://data.zz.baidu.com');
        return $client->request('post', 'urls', [
            'query' => ['site' => $site, 'token' => $token],
            'body' => $urls
        ]);
    }
}