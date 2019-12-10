<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class UpdateForm extends Model
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
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Поле не може бути порожнім'],
            ['email', 'email', 'message' => 'Ви використали невалідний email'],
            ['email', 'string', 'max' => 255],


            ['phone', 'trim'],
            ['phone', 'required', 'message' => 'Поле не може бути порожнім'],

            ['surname', 'trim'],
            ['surname', 'required', 'message' => 'Поле не може бути порожнім'],
            ['surname', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Прізвище повинно містити не менше 2 символів', 'tooLong' => 'Прізвище занадто довге'],

            ['name', 'trim'],
            ['name', 'required', 'message' => 'Поле не може бути порожнім'],
            ['name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Ім\'я повинно містити не менше 2 символів', 'tooLong' => 'Ім\'я занадто довге'],

            ['fathername', 'trim'],
            ['fathername', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'По батькові повинно містити не менше 2 символів', 'tooLong' => 'По батькові занадто довге'],

            ['birthday', 'trim'],

            ['gender', 'in', 'range' => [1, 2]],

            ['city', 'trim'],

            ['password', 'required', 'message' => 'Поле не може бути порожнім'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль повинен містити неменше 6 символів'],

            ['confirm', 'required', 'message' => 'Поле не може бути порожнім'],
            ['confirm', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароль не підтверджено' ],

            ['verifyCode', 'captcha', 'message' => 'Код підтвердження невірний'],
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
            $user = User::findOne($id);
            $user->username = $this->email;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->surname = $this->surname;
            $user->name = $this->name;
            $user->fathername = $this->fathername;
            $user->birthday = $this->birthday;
            $user->gender = $this->gender;
            $user->city = $this->city;
            $user->setPassword($this->password);

            return $user->save();
        }

        return false;
    }
}