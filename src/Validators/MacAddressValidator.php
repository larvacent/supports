<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;


/**
 * Mac Address 校验
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class MacAddressValidator
{
    /**
     * @var array
     */
    public $patterns = [
        '/^[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}$/i',
        '/^[0-9a-f]{4}[\. ]{1}[0-9a-f]{4}[\. ]{1}[0-9a-f]{4}$/i',
        '/^[0-9a-f]{6}[\-: ]{1}[0-9a-f]{6}$/i',
        '/^[0-9a-f]{12}$/i',
    ];

    public function validate($attribute, $value, $parameters, $validator)
    {
        foreach ($this->patterns as $pattern){
            if (preg_match($pattern, $value)){
                return true;
            }
        }
        return false;
    }
}