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
class HttpProClient extends BaseObject
{
    use HasHttpRequest {
        post as public;
        get as public;
        postJSON as public;
        postXML as public;
    }

    /**
     * @var float
     */
    public $timeout = 5.0;

    /**
     * @var float
     */
    public $connectTimeout = 5.0;

    /**
     * @var string
     */
    protected $baseUri = '';

    /**
     * Http client options.
     *
     * @var array
     */
    public $httpOptions = ['http_errors' => false];

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
     * 设置参数
     * @param array $httpOptions
     * @return string
     */
    public function setHttpOptions($httpOptions)
    {
        $this->httpOptions = array_merge($this->httpOptions, $httpOptions);
        return $this;
    }

    /**
     * Make a http request.
     *
     * @param string $method
     * @param string $endpoint
     * @param array $options http://docs.guzzlephp.org/en/latest/request-options.html
     * @return HttpResponse
     */
    protected function request($method, $endpoint, $options = [])
    {
        return new HttpResponse($this->getHttpClient()->{$method}($endpoint, $options));
    }
}