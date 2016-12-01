<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use dektrium\user\models\User as BaseUser;

/**
 * This is overriding the model class for table "user".
 *
 * @property string $avatar 
 * @property string $banner 
 *
 * @author Argaditya <argadityarss@gmail.com>
 */
class User extends BaseUser
{
	

}
