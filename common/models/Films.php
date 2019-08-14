<?php

namespace common\models;

use common\models\queries\FilmsQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "films".
 *
 * @property int $id
 * @property int $cinema_hall_id
 * @property string $title
 * @property string $image
 * @property double $price
 * @property int $start_at
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CinemaHall $cinemaHall
 */
class Films extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const MAX_FILE_SIZE = 1024 * 1024 * 3;

    /**
     * @var $file
     */
    public $file;

    /**
     * @return array
     */
    public function getAllStatusArray()
    {
        return [
            static::STATUS_ACTIVE => 'Активный',
            static::STATUS_NOT_ACTIVE => 'Не активный',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->formatter->asDatetime($this->start_at);
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'films';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cinema_hall_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            ['start_at', 'date', 'timestampAttribute' => 'start_at'],
            ['status', 'default', 'value' => static::STATUS_ACTIVE],
            ['status', 'in', 'range' => [static::STATUS_ACTIVE, static::STATUS_NOT_ACTIVE]],
            [['title', 'image'], 'string', 'max' => 255],
            [['cinema_hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => CinemaHall::class, 'targetAttribute' => ['cinema_hall_id' => 'id']],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png',
                'maxSize' => static::MAX_FILE_SIZE,
                'tooBig' => 'Limit is 3 MB'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cinema_hall_id' => 'Cinema Hall ID',
            'title' => 'Title',
            'image' => 'Image',
            'price' => 'Price',
            'start_at' => 'Start At',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (!is_null($this->start_at) && !is_int($this->start_at)) {
            $this->start_at = strtotime($this->start_at);
        }

        return parent::beforeValidate();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinemaHall()
    {
        return $this->hasOne(CinemaHall::className(), ['id' => 'cinema_hall_id']);
    }

    /**
     * @return FilmsQuery
     */
    public static function find()
    {
        return new FilmsQuery(get_called_class());
    }

    /**
     * Method check server file path
     */
    public function checkPath($path)
    {
        if (!is_dir($path)) {
            FileHelper::createDirectory($path);
        }
        return $path;
    }

    /**
     * @return bool
     */
    public function upload()
    {
        $this->checkPath(Yii::getAlias('@webroot/uploads/films'));
        $serverPath = Yii::getAlias('@webroot/uploads/films/' . date('d-m-Y', time()));
        $webPath = Yii::getAlias('@web/uploads/films/' . date('d-m-Y', time()));
        $file = UploadedFile::getInstance($this, 'file');

        if ($file && $file->error === 0) {
            //prepare file name
            $fileName = random_int(1, 999) . '_' . time() . '.' . $file->extension;
            //prepare file server path
            $filePath = $this->checkPath($serverPath) . '/' . $fileName;
            //prepare file web path
            $this->image = $webPath . '/' . $fileName;
            //if non set errors
            if (!$file->hasError) {
                //upload file
                $result = $file->saveAs($filePath);
                //check uploaded
                if(!$result) {
                    return false;
                }
                return true;
            }
        }
        return false;
    }
}
