<?php

/**
 * Модель данных для таблицы "db_article".
 *
 * Столбцы таблицы 'db_article':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $id_author
 * @property string $dates_temp
 * @property string $status
 */
class ArticleForm extends CActiveRecord
{
    /**
     * Загружаемые файлы
     * @var CUploadedFile[]
     */
    public $files;

	/**
     * Название таблицы
	 * @return string
	 */
	public function tableName()
	{
		return 'db_article';
	}

	/**
     * Правила валидации модели
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('title, content, id_author, status', 'required'),
			array('id_author', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('status', 'length', 'max'=>24),
			array('dates_temp', 'safe'),
            array(array('files'), 'file', 'safe'=>true, 'allowEmpty'=>true,
                'types' => 'png, jpg, pdf, doc, zip', 'maxFiles'=>4, 'maxSize'=>1024*1024*5),
			array('id, title, content, id_author, dates_temp, status', 'safe', 'on'=>'search'),
		);
	}

	/**
     * Правила связей с другими моделями
	 * @return array
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
     * Определения заголовков атрибутов
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Тема',
			'content' => 'Содержание',
			'id_author' => 'ID автора',
			'dates_temp' => 'Дата публикации',
			'status' => 'Статус',
            'files' => 'Файлы',
		);
	}

	/**
     * Поиск статей специалистов
	 * @return CActiveDataProvider
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('id_author',$this->id_author);
		$criteria->compare('dates_temp',$this->dates_temp,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @param string $className
	 * @return ArticleForm
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Загрузка изображений в формате id-date_temp-uniqueId.extension
     * @return boolean
     */
    public function upload()
    {
        if ($this->files)
        {
            foreach ($this->files as $file)
            {
                $file->saveAs(Yii::app()->params['uploadUrl'] .
                    $this->id . '-' . $this->dates_temp . '-' .
                    uniqid() . '.' . $file->getExtensionName());
            }
        }
        return true;
    }
}
