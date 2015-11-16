<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use app\models\Reviews;
use app\models\Users;

class ReviewsSearch extends Reviews
{

    public $date;
    public $user;
    public $review;
    public $site;
    public $type;

    public function search() {

        $query = Reviews::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['date' => 'desc']
            ],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $dataProvider;
    }

}