<?php

namespace app\models;
use app\models\curso;
use app\models\CursoSearch;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $id
 * @property integer $matricula
 * @property string $nome
 * @property string $sexo
 * @property integer $id_curso
 * @property integer $ano_ingresso
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matricula', 'id_curso', 'ano_ingresso','nome', 'sexo'],'required','message'=>'Este
			campo é obrigatório'],
            ['matricula', 'integer','message'=>'A Matricula tem que ser um número inteiro'],
			['id_curso', 'integer','message'=>'O Curso tem que ser um número inteiro'],
			['ano_ingresso', 'integer','message'=>'O Ano de Ingresso tem que ser um número inteiro'],
            [['nome'], 'string', 'max' => 200],
            [['sexo'], 'string', 'max' => 1],
			
            [['matricula'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matricula' => 'Matrícula',
            'nome' => 'Nome Completo',
            'sexo' => 'Sexo',
            'id_curso' => 'Curso de Graduação',
            'ano_ingresso' => 'Ano de Ingresso',
        ];
    }
	 public function afterFind(){
		parent::afterFind();
		$teste = strtolower($this->nome);
		$teste1 = strtolower($this->sexo);
		$teste = ucwords($teste);
		$this->nome = $teste;
		$this->id_curso = Curso::findOne($this->id_curso)->nome;
		
		if ($teste1 == 'm')
			$teste1 = "Masculino";
			else
			$teste1 = "Feminino";
		
		$this->sexo = $teste1;
	}
	public function beforeValidate(){
		$teste1 = strtoupper($this->nome);
		$this->nome = $teste1;
		return parent::beforeValidate();
	}
	
}
