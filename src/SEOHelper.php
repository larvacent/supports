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
     * 百度 Push
     * @param string $site 网站
     * @param string $token Token
     * @param string|array $urls Url列表
     * @return mixed
     */
    public static function baiduPush($site, $token, $urls)
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
     * 百度MIP推送
     * @param string $site
     * @param string $token
     * @param string|array $urls
     * @return mixed
     */
    public static function baiduMIPPush($site, $token, $urls)
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
            'query' => ['site' => $site, 'token' => $token, 'type' => 'mip'],
            'body' => $urls
        ]);
    }

    /**
     * 百度 AMP 推送
     * @param string $site
     * @param string $token
     * @param string|array $urls
     * @return mixed
     */
    public static function baiduAMPPush($site, $token, $urls)
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
            'query' => ['site' => $site, 'token' => $token, 'type' => 'amp'],
            'body' => $urls
        ]);
    }

    /**
     * AMP MIP 清理
     * @param string $token Token
     * @param string $url Url
     * @return mixed
     */
    public static function baiduAMPClean($token, $url)
    {
        $endpoint = '/update-ping/c/' . urlencode($url);
        $client = new HttpClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://c.mipcdn.com');
        return $client->post($endpoint, ['key' => $token]);
    }

    /**
     * 天级收录
     * @param string $appid AppID
     * @param string $token Token
     * @param string|array $urls Url列表
     * @return HttpResponse
     */
    public static function baiduDayInclusionPush($appid, $token, $urls)
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
    public static function baiduWeekInclusionPush($appid, $token, $urls)
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
     * 神马 MIP 推送
     * @param string $site
     * @param string $username
     * @param string $token
     * @param string|array $urls
     * @return mixed
     */
    public static function shenmaMIPPush($site, $username, $token, $urls)
    {
        if (is_array($urls)) {
            $urls = implode("\n", $urls);
        }
        $client = new HttpClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://data.zhanzhang.sm.cn');
        return $client->request('push', 'urls', [
            'query' => ['site' => $site, 'username' => $username, 'resource_name' => 'mip_add', 'token' => $token],
            'body' => $urls
        ]);
    }

    /**
     * AMP MIP 清理
     * @param string $site
     * @param string $username
     * @param string $token Token
     * @param string|array $urls
     * @return mixed
     */
    public static function shenmaAMPClean($site, $username, $token, $urls)
    {
        if (is_array($urls)) {
            $urls = implode("\n", $urls);
        }
        $client = new HttpClient();
        $client->setHttpOptions([
            'http_errors' => false,
        ]);
        $client->setBaseUri('http://data.zhanzhang.sm.cn');
        return $client->request('push', 'urls', [
            'query' => ['site' => $site, 'username' => $username, 'resource_name' => 'mip_clean', 'token' => $token],
            'body' => $urls
        ]);
    }
}