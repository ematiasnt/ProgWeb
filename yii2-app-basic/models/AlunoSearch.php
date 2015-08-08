<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\aluno;

/**
 * AlunoSearch represents the model behind the search form about `app\models\aluno`.
 */
class AlunoSearch extends aluno
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],

            ['matricula', 'integer','message'=>'A Matricula tem que ser um inteiro'],
			['id_curso', 'integer','message'=>'O Curso tem que ser um inteiro'],
			['ano_ingresso', 'integer','message'=>'O Ano de Ingresso tem que ser um número inteiro.'],
            [['nome', 'sexo'], 'safe'],
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
        $query = aluno::find();

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
            'matricula' => $this->matricula,
            'id_curso' => $this->id_curso,
            'ano_ingresso' => $this->ano_ingresso,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'sexo', $this->sexo]);

        return $dataProvider;
    }


}
