<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Supports\Validators;

/**
 * Class Latitude
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class LatitudeValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        if ($value < -90 || $value > 90) {
            return false;
        }
        return true;
    }
}