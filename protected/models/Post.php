<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $post_id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $desc
 * @property string $content
 * @property string $picture
 * @property integer $status
 * @property string $create_date
 *
 */
class Post extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id,user_id ,title, desc, content, picture', 'required'),
			array('category_id,user_id ,status', 'numerical', 'integerOnly'=>true),
			array('title, picture', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('post_id ,category_id, user_id , title, desc, content, picture, status, create_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'user='=>array(
                self::BELONGS_TO,
                'User',
                'user_id'
            ),
            'category'=>array(
                self::BELONGS_TO,
                'Category',
                'category_id'
            )

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_id' => 'Số thứ tự',
			'category_id' => 'Danh mục',
            'user_id'=>'Nguời đăng',
			'title' => 'Tiêu đề',
			'desc' => 'Tóm tắt',
			'content' => 'Nội dung',
			'picture' => 'Ảnh đại diện',
			'status' => 'tragj thái',
			'create_date' => 'Ngày Tạo ',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('category_id',$this->category_id);
        $criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
