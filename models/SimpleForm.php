<?php

namespace app\models;

use Yii;
use yii\base\Model;



class SimpleForm extends Model {

    public $input;
    public $textarea;
    public $select;
    public $uploadFile;
    public $uploadMulti;
    public $checkbox;
    public $checkboxList;
    public $radio;
    public $radioList;

    public function rules()
    {
        return [
           ['input', 'required'],
           ['textarea','string','max'=>50],
        ];
    }



}