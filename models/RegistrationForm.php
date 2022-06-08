<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * RegistrationForm is the model behind the contact form.
 */
class RegistrationForm extends Model
{

    public $fio;
    public $email;
    public $birthDate;
    public $phone;
    public $city;
    public $age;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fio', 'password', 'email', 'birthDate', 'phone', 'city', 'age'], 'required'],

//            ['email', 'email'],

//            ['password', 'password'],

//            [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator', 'countryAttribute'=>'country_code'],

//            ['birthDate', 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function save(){
        $user = new User();
        $user->setPassword($this->password);
        $user->createAuthKey();
        $user->role_id = 1;
        $user->fio = $this->fio;
        $user->status_id = 1;
        $user->acceptance_id = 1;
        $user->email = $this->email;
        $user->age = $this->age;
        $user->phone = $this->phone;
        $user->city = $this->city;
        $user->public_status = '-';


//        VarDumper::dump($user);die;

        $res = $user->save();
        if (!$res) {
            VarDumper::dump($user->getErrors()); die;
        }
        return $res;
    }
}
