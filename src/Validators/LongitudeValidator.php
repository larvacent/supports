<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;


/**
 * Class Longitude
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class LongitudeValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        if ($value < -180 || $value > 180) {
            return false;
        }
        return true;
    }
}