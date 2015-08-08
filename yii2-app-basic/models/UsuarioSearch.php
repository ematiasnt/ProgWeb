<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\usuario;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\usuario`.
 */
class UsuarioSearch extends usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['login', 'senha', 'nome', 'email', 'tipo', 'data_cadastro'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = usuario::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'data_cadastro' => $this->data_cadastro,
        ]);

        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'senha', $this->senha])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
