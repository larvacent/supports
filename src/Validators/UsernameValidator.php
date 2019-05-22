<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;

/**
 * Class UsernameValidator
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class UsernameValidator
{
    public $pattern = '/^[-a-zA-Z0-9_]+$/u';


    public function validate($attribute, $value, $parameters, $validator)
    {
        return preg_match($this->pattern, $value);
    }
}