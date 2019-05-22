<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;

use Larva\Supports\IDCard;

/**
 * 中国大陆居民身份证验证
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class IdCardValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return IDCard::validateCard($value);
    }
}