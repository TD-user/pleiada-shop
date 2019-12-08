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
    public $fio;
    public function  rules()
    {
        return ([
            [['username','fio'],'required'],
            ['username','unique','targetClass'=>'backend\models\Admin'],
            ['password','safe'],
            ['role','safe']

        ]);
    }
    public function update($id)
    {
        $manager = Yii::$app->authManager;
        $role = array_keys($manager->getRolesByUser($id))[0];
        $item = $manager->getRole($role);
        $manager->revoke($item,$id);

        $user = Admin::findOne($id);
        $user->username =$this->username;
        if(!empty($this->password))
        $user->setPassword($this->password);
        $user->updated_at = strtotime(date("Ymd"));
        $user->fio =$this->fio;

        $authorRole =$manager->getRole($this->role);
        $manager->assign($authorRole, $id);



        return $user->save();
    }
}