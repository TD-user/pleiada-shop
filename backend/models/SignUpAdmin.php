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

    public function  rules()
    {
        return ([
            [['username','password'],'required'],
            ['username','unique','targetClass'=>'app\models\Admin'],
            ['password','string','min'=>3,'max'=>15],
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


        return $user->save();
    }
}