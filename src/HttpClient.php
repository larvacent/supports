<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports;

use Larva\Supports\Traits\HasHttpRequest;

/**
 * Http 客户端
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class HttpClient extends BaseObject
{
    use HasHttpRequest {
        post as public;
        get as public;
        postJSON as public;
        postXML as public;
        request as public;
    }

    /**
     * @var float
     */
    public $timeout = 5.0;

    /**
     * @var string
     */
    protected $baseUri = '';

    /**
     * 获取基础路径
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * 设置基础路径
     * @param string $baseUri
     * @return $this
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * 获取基础路径
     * @param array $httpOptions
     * @return string
     */
    public function setHttpOptions($httpOptions)
    {
        $this->httpOptions = $httpOptions;
        return $this;
    }

    /**
     * 获取 响应的 Header
     * @param string $url
     * @param array $headers
     * @return array|false
     */
    public static function getHeaders($url, $headers = [])
    {
        $http = new static(['timeout' => 20, 'verify' => false, 'headers' => $headers]);
        /** @var \Psr\Http\Message\ResponseInterface $response */
        $response = $http->getHttpClient()->get($url);
        return $response->getHeaders();
    }

    /**
     * 检查 CORS 跨域
     * @param string $url
     * @param string $origin
     * @return bool
     */
    public static function checkCors($url, $origin)
    {
        $headers = static::getHeaders($url, ['Referer' => $origin, 'Origin' => $origin]);
        if (in_array($headers['Access-Control-Allow-Origin'][0], [$origin, '*'])) {
            return true;
        }
        return false;
    }
}