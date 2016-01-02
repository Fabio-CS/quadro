<?php

namespace app\components\validators;

use yii\validators\Validator;

class SenhaValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (empty($model->password_repeat)) {
            $this->addError($model, "password_repeat", 'Confirme a senha deve ser preenchido!');
        }else if(!empty($model->password_repeat) && empty($model->password)){
            $this->addError($model, "password", 'A senha deve ser preenchida!');
        }else if($model->password_repeat != $model->password){
            $this->addError($model, "password_repeat", 'Senhas diferentes!');
        }
    }
}

