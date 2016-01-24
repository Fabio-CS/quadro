<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuarios;
/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $matricula;
    public $password;

    private $usuario = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // matricula e senha são obrigatórios
            [['matricula', 'password'], 'required', 'on' => 'web'],
            // password is validated by validatePassword()
            ['password', 'validatePassword', 'on' => 'web'],
            ['matricula', 'required', 'on' => 'local'],
            ['matricula', 'validateMatricula', 'on' => 'local']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Senha',
            'num_matricula' => 'Matrícula',];    
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
            $user = $this->getUsuario();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Matrícula ou senha incorretas.');
            }
        }
    }
    public function validateMatricula($attribute, $params){ 
        if (empty(Usuarios::findByMatricula($this->matricula))) {
            $this->addError($attribute, 'Matrícula não encontrada, tente novamente, se persistir procure o RH');
        }
     }
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUsuario());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUsuario()
    {
        if ($this->usuario === false) {
            $this->usuario = Usuarios::findByMatricula($this->matricula);
        }

        return $this->usuario;
    }
}
