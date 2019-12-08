<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.11.2019
 * Time: 15:36
 */
namespace backend\models;



class  SignUpAdmin extends \yii\base\Model
{
    public $username;
    public $password;
    public $role;
    public $fio;

    public function  rules()
    {
        return ([
            [['username','password','fio'],'required' ,'message' => 'Поле не може бути порожнім'],
            ['username','unique','targetClass'=>'app\models\Admin' ,'message' => 'Логін повинен бути унікальним'],
            ['password','string','min'=>3,'max'=>15 ,'tooShort' => 'Пароль Повинен  містити не менше 2 символів', 'tooLong' => 'Пароль занадто довгий'],
            ['role','safe']

        ]);
    }
    public function signup()
    {

        $user = new Admin();
        $user->username =$this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = strtotime(date("Ymd"));
        $user->updated_at = strtotime(date("Ymd"));
        $user->fio = $this->fio;


        return $user->save();
    }
}