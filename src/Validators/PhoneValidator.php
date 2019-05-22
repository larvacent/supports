<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;

/**
 * 中国大陆手机号码验证
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class PhoneValidator
{
    /**
     * @var string the regular expression for matching mobile.
     */
    public $mobilePattern = '/^1[345789]{1}[\d]{9}$|^166[\d]{8}$|^19[89]{1}[\d]{8}$/';


    public function validate($attribute, $value, $parameters, $validator)
    {
        if (!preg_match($this->mobilePattern, $value)) {
            return false;
        }
        return true;
    }
}