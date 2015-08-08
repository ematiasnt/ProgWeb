<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\aluno */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

     <h1><?= Html::encode($this->title) ?></h1> 

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	 
	 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'matricula',
            'nome',
            'sexo',
            'id_curso',
            'ano_ingresso',
        ],
    ]) ?>
	
	<h3>Em nossa base, existe(m) <?= $models ?> aluno(s) de  <?= $model->ano_ingresso ?>.</h3>
	

</div>
