<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;


/**
 * Class Nickname
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class NicknameValidator
{
    public $pattern = '/^[-a-zA-Z0-9_\x{4e00}-\x{9fa5}\.@]+$/u';

    public function validate($attribute, $value, $parameters, $validator)
    {
        return preg_match($this->pattern, $value);
    }
}