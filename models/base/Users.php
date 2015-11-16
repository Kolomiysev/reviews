<?php

namespace app\models\base;

use Yii;


class Users extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 25]
        ];
    }

}