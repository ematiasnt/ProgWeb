<?php

namespace app\controllers;

use Yii;
use app\models\aluno;
use app\models\AlunoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\curso;
use app\models\CursoSearch;

/**
 * AlunoController implements the CRUD actions for aluno model.
 */
class AlunoController extends Controller
{
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all aluno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
        ]);
    }
	public function actionTurma()
    {
		//$aluno = aluno::findOne($id);
		//$curso = $aluno->curso->nome;
		
		//$num = Yii::$app->request->queryParams;
        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('turma', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
        ]);
    }

    /**
     * Displays a single aluno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)    {
		
		$teste = $this->findModel($id);
		$models = new Aluno();
		$models->loadDefaultValues();
		$models = aluno::find()->where(['ano_ingresso' => $teste->ano_ingresso])->count();
	    return $this->render('view', [
            'model' => $teste ,'models' => $models
        ]);
    }
	
	public function actionView1()
    {
		$model = new aluno();
		//$array_cursos = ArrayHelper::map(CursoSearch::find()->all(),['id','nome']);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,/*'array_cursos' => $array_cursos,*/
            ]);
        }

    }
	
    /**
     * Creates a new aluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new aluno();
		//$array_cursos = ArrayHelper::map(CursoSearch::find()->all(),['id','nome']);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,/*'array_cursos' => $array_cursos,*/
            ]);
        }
    }


    /**
     * Updates an existing aluno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

	  
	  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing aluno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
			
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = aluno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
