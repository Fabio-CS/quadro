<?php

namespace app\components;

use yii\validators\Validator;

class SenhaValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (isEmpty($model->$attribute)) {
        $this->addError($model, $attribute, 'Repetir a senha deve ser preenchido!');
        
        }else if($model->$attribute != $model->senha){
            $this->addError($model, $attribute, 'Senhas não conferem');
        }
    }
}

