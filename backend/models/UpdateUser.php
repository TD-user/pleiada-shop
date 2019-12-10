<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class UpdateUser extends Model
{
    public $id;
    public $username;
    public $email;
    public $phone;
    public $surname;
    public $name;
    public $fathername;
    public $birthday;
    public $gender;
    public $city;
    public $password;
    public $confirm;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['email', 'required', 'message' => 'Поле не може бути порожнім'],
            ['email', 'email', 'message' => 'Ви використали невалідний email'],

            ['phone', 'required', 'message' => 'Поле не може бути порожнім'],


            ['surname', 'required', 'message' => 'Поле не може бути порожнім'],
            ['surname', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Прізвище повинно містити не менше 2 символів', 'tooLong' => 'Прізвище занадто довге'],


            ['name', 'required', 'message' => 'Поле не може бути порожнім'],
            ['name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Ім\'я повинно містити не менше 2 символів', 'tooLong' => 'Ім\'я занадто довге'],


            ['fathername', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'По батькові повинно містити не менше 2 символів', 'tooLong' => 'По батькові занадто довге'],

            ['birthday', 'safe'],


            ['gender', 'in', 'range' => [1, 2]],

            ['city', 'safe'],


        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */


        public function userUpdate($id)
    {
if ($this->validate()) {
    $model = User::findOne($id);

    $model->email = $this->email;
    $model->phone = $this->phone;
    $model->surname = $this->surname;
    $model->name = $this->name;
    $model->fathername = $this->fathername;
    $model->birthday = $this->birthday;
    $model->gender = $this->gender;
    $model->city = $this->city;


    return $model->save();
}
    }
}