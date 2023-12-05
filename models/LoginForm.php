<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username'], 'required', 'message' => '{attribute} no puede estar vacío.'],
            [['password'], 'required', 'message' => '{attribute} no puede estar vacía.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'password' => 'Contraseña',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o contraseña incorrecta.');
            }
        }
    }

    

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);

            if ($this->_user === null) {
                $personaldata = Datospersonales::findByCedula($this->username);

                if ($personaldata !== null) {
                    $this->_user = new User();
                    $this->_user->username = $personaldata->Ci;
                    $this->_user->setPassword($personaldata->Ci);
                    $now = \Yii::$app->formatter;
                    $this->_user->Created_at = $now->asDatetime(new \DateTime(), 'php:Y-m-d H:i:s');                    $this->_user->Tipo = 11;
                    $this->_user->Auth_key = Yii::$app->security->generateRandomString();
                    $this->_user->save(); // Save the user to the database
                }
            }
        }

        return $this->_user;
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            if ($user !== null && Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                $user->refresh(); // Refresh user to get the latest data from the database
                $this->registrarVisita($user);
                return true;
            }
        }
        return false;
    }

    protected function registrarVisita($user)
    {
        $visita = new Transaccion();
        $visita->user_id = $user->id; // Use $user instead of $this->getUser()
        $visita->action = 'login';
        $visita->nombre_tabla = 'user';
        // Add more information about the visit if necessary
        $visita->save();
    }

}
