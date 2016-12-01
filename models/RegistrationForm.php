<?php 

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use dektrium\user\models\User;

/**
* This class is overriding Dektrium's default RegistrationForm Class
*/
/**
 * This is overriding the model class for RegistrationForm Class.
 *
 * @property string $name 
 * @property string $password_repeat 
 *
 * @author Argaditya <argadityarss@gmail.com>
 */
class RegistrationForm extends BaseRegistrationForm
{
	/**
     * Add new fields
     * @var string name
     * @var string password_repeat
     */
    public $name;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['name', 'required'];
        $rules[] = ['name', 'string', 'max' => 255];
        $rules[] = ['name', 'match', 'pattern' => '/^[a-zA-Z\s]*$/'];
        $rules[] = ['password', 'compare', 'compareAttribute' => 'username', 'operator' => '!='];
        $rules[] = ['password_repeat', 'compare', 'compareAttribute' => 'password'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = \Yii::t('user', 'Nama Lengkap');
        $labels['password_repeat'] = \Yii::t('user', 'Konfirmasi Password');
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(\dektrium\user\models\User $user)
    {
        // here is the magic happens
        $user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = new BaseProfile();
        $profile->setAttributes([
            'name' => $this->name,
        ]);
        $user->setProfile($profile);
    }
}

