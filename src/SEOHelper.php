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

    /**
     * 天级收录
     * @param string $appid AppID
     * @param string $token Token
     * @param string|array $urls Url列表
     * @return HttpResponse
     */
    public static function baiduDayInclusion($appid, $token, $urls)
    {
        if (is_array($urls)) {
            $urls = implode("\n", $urls);
        }
        $client = new HttpProClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://data.zz.baidu.com');
        return $client->request('post', 'urls', [
            'query' => ['appid' => $appid, 'token' => $token, 'type' => 'batch'],
            'body' => $urls
        ]);
    }

    /**
     * 周级收录
     * @param string $appid AppID
     * @param string $token Token
     * @param string|array $urls Url列表
     * @return HttpResponse
     */
    public static function baiduWeekInclusion($appid, $token, $urls)
    {
        if (is_array($urls)) {
            $urls = implode("\n", $urls);
        }
        $client = new HttpProClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://data.zz.baidu.com');
        return $client->request('post', 'urls', [
            'query' => ['appid' => $appid, 'token' => $token, 'type' => 'batch'],
            'body' => $urls
        ]);
    }

    /**
     * AMP MIP 清理
     * @param string $token Token
     * @param string $url Url
     * @return mixed
     */
    public static function baiduAMPPing($token, $url)
    {
        $endpoint = '/update-ping/c/' . urlencode($url);
        $client = new HttpClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://c.mipcdn.com');
        return $client->post($endpoint, ['key' => $token]);
    }
}