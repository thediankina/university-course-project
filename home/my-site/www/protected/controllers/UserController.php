<?php

class UserController extends Controller
{
	/**
     * Стандартный макет для представлений
	 * @var string
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array
	 */
	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	/**
	 * Правила доступа
	 * @return array
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('index','view','update'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

    /**
     * Данные о пользователе (в разработке)
     *
     * Здесь будут отображаться все заявки, которые принял специалист
     * @param integer $id
     * @throws CHttpException
     */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Регистрация нового пользователя
	 */
	public function actionCreate()
	{
		$model=new User;

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if(Yii::app()->phpBB->userAdd($model->username, $model->user_password, $model->user_email)) {
                Yii::app()->user->setFlash('success','Вы успешно прошли регистрацию');
                $this->refresh();
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    /**
     * Обновление данных о пользователе (в разработке)
     * @param integer $id
     * @throws CHttpException
     */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    /**
     * Удаление пользователя
     * @param integer $id
     * @throws CDbException
     * @throws CHttpException
     */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Список всех пользователей (в разработке)
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Панель администратора (в разработке)
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Возвращает модель данных, основываясь на первичном ключе, полученном из GET запроса
	 * @param integer $id
	 * @return User
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Запрашиваемая страница не существует');
		return $model;
	}

	/**
	 * Представляет AJAX валидацию (в разработке)
	 * @param User $model
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
