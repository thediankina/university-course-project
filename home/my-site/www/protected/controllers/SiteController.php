<?php

class SiteController extends Controller
{
	/**
	 * Объявляет методы, основанные на классах (в разработке)
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Главная страница
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Вывод ошибок
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Форма входа
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];

			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$this->render('login',array('model'=>$model));
	}

	/**
    * Форма обновления FAQ
    */
	public function actionFAQ()
	{
	    $model=new FAQForm;

	    if(isset($_POST['FAQForm']))
	    {
	        $model->attributes=$_POST['FAQForm'];
	        // $model->id_author=Yii::app()->user->getId(); Нужна связь через три таблицы
	        $model->id_author = 1;      // Пока публикации все от администратора

	        if($model->save()) {
	            Yii::app()->user->setFlash('success', "Вопрос-ответ добавлен");
	            $this->refresh();
            }
            else
                Yii::app()->user->setFlash('error', "Произошла ошибка");
        }

        $this->render('faq',array('model'=>$model));
    }

    /**
    * Форма добавления статьи
    */
    public function actionArticle()
    {
        $model=new ArticleForm;

        if(isset($_POST['ArticleForm']))
        {
            $model->attributes=$_POST['ArticleForm'];
            $model->id_author = 1;      // Пока публикации все от администратора
            $model->status = 'Опубликовано';    // Статьи администратора публикуются автоматически
            $model->dates_temp = date("Y-m-d");
            $model->files=CUploadedFile::getInstances($model,'files');

            if ($model->save()) {
                $model->upload();
                Yii::app()->user->setFlash('success', "Статья добавлена");
                $this->refresh();
            }
        }
        $this->render('article',array('model'=>$model));
    }

	/**
	 * Метод выхода из учетной записи
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}