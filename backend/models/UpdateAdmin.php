<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.11.2019
 * Time: 15:36
 */
namespace backend\models;



use Yii;

class  UpdateAdmin extends \yii\base\Model
{
    public $id;
    public $username;
    public $password;
    public $auth_key;
    public $role;
    public function  rules()
    {
        return ([
            [['username'],'required'],
            ['username','unique','targetClass'=>'backend\models\Admin'],
            ['password','safe'],
            ['role','safe']

        ]);
    }
    public function update($id)
    {
        $user = Admin::findOne($id);
        $user->username =$this->username;
        if(!empty($this->password))
        $user->setPassword($this->password);
        $user->updated_at = strtotime(date("Ymd"));
        $manager = Yii::$app->authManager;
        $authorRole =$manager->getRole($this->role);
        $manager->assign($authorRole, $id);



        return $user->save();
    }
}