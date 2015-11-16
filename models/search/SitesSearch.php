<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use app\models\Sites;

class SitesSearch extends Sites
{

    public $name;
    public $url;
    public $rating;
    public $country;
    public $pagination=false;

    public function rules() {
        return [
            [['name','url'], 'safe']
        ];
    }

    public function search() {

        $query = Sites::find()->limit(5);

       // $query->leftJoin('reviews');

        /*
        $query->joinWith('capacity');
        $query->joinWith('profile');
        $query->joinWith('user');
        */

        // $query->leftJoin(Users::tableName() . ' AS reseller', 'reseller.id = ' . self::tableName() . '.reseller_id');

        if($this->pagination==true){

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => ['rating' => 'desc']
                ],
                'pagination' => [
                    'pageSize' => 10
                ]
            ]);

        } else {

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => ['rating' => 'desc']
                ],
                'pagination' => false
            ]);

        }

        $query->andFilterWhere(['=',Sites::tableName().'.country', $this->country]);

        /*

SELECT s.name, SUM( r.type )
FROM sites AS s
LEFT JOIN reviews AS r ON s.id = r.site
GROUP BY s.id
LIMIT 0 , 30

         */

        /*
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['IN',Configurations::tableName().'.id', $this->id]);
        $query->andFilterWhere(['=',Configurations::tableName().'.user_id', $this->user_id]);
        $query->andFilterWhere(['LIKE',Configurations::tableName().'.amount', $this->amount]);
        $query->andFilterWhere(['=',Configurations::tableName().'.status', $this->status]);
        $query->andFilterWhere(['LIKE', Hardware::tableName() . '.name', $this->hardware_id]);
        $query->andFilterWhere(['LIKE', Capacity::tableName() . '.name', $this->capacity_id]);
        $query->andFilterWhere(['LIKE', Profiles::tableName() . '.first_name', $this->first_name]);
        $query->andFilterWhere(['LIKE', Profiles::tableName() . '.last_name', $this->last_name]);
        $query->andFilterWhere(['LIKE', Users::tableName() . '.email', $this->email]);
        */



        return $dataProvider;

    }

}