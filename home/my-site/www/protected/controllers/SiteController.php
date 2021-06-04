<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
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
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
    	 * Displays the login page
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
            }

    		$this->render('faq',array('model'=>$model));
    	}

        public function actionArticle()
        {
            $model=new ArticleForm;

            if(isset($_POST['ArticleForm']))
            {
                $model->attributes=$_POST['ArticleForm'];
                $model->id_author = 1;      // Пока публикации все от администратора
                $model->status = 'Опубликовано';    // Статьи администратора публикуются автоматически
                $model->dates_temp = date("Y-m-d");
                $model->images=CUploadedFile::getInstances($model,'images');

                if ($model->save()) {
                    $model->upload();
                    Yii::app()->user->setFlash('success', "Статья добавлена");
                    $this->refresh();
                }
                else {
                    Yii::app()->user->setFlash('error', "Ошибка загрузки файла");
                }
            }
            $this->render('article',array('model'=>$model));
        }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}