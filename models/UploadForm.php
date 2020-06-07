<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $uploadFiles;

    public function rules()
    {
        return [
            [['uploadFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 5],
        ];
    }

    public function upload()
    {
        $dictionary = array(
            'й' => 'i',
            'ц' => 'c',
            'у' => 'u',
            'к' => 'k',
            'е' => 'e',
            'н' => 'n',
            'г' => 'g',
            'ш' => 'sh',
            'щ' => 'shch',
            'з' => 'z',
            'х' => 'h',
            'ъ' => '',
            'ф' => 'f',
            'ы' => 'y',
            'в' => 'v',
            'а' => 'a',
            'п' => 'p',
            'р' => 'r',
            'о' => 'o',
            'л' => 'l',
            'д' => 'd',
            'ж' => 'zh',
            'э' => 'e',
            'ё' => 'e',
            'я' => 'ya',
            'ч' => 'ch',
            'с' => 's',
            'м' => 'm',
            'и' => 'i',
            'т' => 't',
            'ь' => '',
            'б' => 'b',
            'ю' => 'yu',

            'Й' => 'I',
            'Ц' => 'C',
            'У' => 'U',
            'К' => 'K',
            'Е' => 'E',
            'Н' => 'N',
            'Г' => 'G',
            'Ш' => 'SH',
            'Щ' => 'SHCH',
            'З' => 'Z',
            'Х' => 'X',
            'Ъ' => '',
            'Ф' => 'F',
            'Ы' => 'Y',
            'В' => 'V',
            'А' => 'A',
            'П' => 'P',
            'Р' => 'R',
            'О' => 'O',
            'Л' => 'L',
            'Д' => 'D',
            'Ж' => 'ZH',
            'Э' => 'E',
            'Ё' => 'E',
            'Я' => 'YA',
            'Ч' => 'CH',
            'С' => 'S',
            'М' => 'M',
            'И' => 'I',
            'Т' => 'T',
            'Ь' => '',
            'Б' => 'B',
            'Ю' => 'YU',

            '\-' => '-',
            '\s' => '-',

            '[^a-zA-Z0-9\-]' => '',

            '[-]{2,}' => '-',
        );

        if ($this->validate()) {
            foreach ($this->uploadFiles as $file) {
                $baseName = $file->baseName;
                foreach ($dictionary as $from => $to)
                {
                    $baseName = mb_ereg_replace($from, $to, $baseName);
                }

                $baseName = mb_substr($baseName, 0, 100, \Yii::$app->charset);

                $baseName = mb_strtolower($baseName, \Yii::$app->charset);

                $baseName = uniqid().'_'.trim($baseName, '-');

                $file->saveAs(Yii::getAlias('@webroot/uploads') . '/' . $baseName . '.' . $file->extension);

                \Yii::$app->db->createCommand()->batchInsert('upload_info',
                    ['name', 'ext', 'created_at'],
                    [
                        [$baseName, $file->extension, date("Y-m-d H:i:s", strtotime('+3 hours'))],
                    ])
                    ->execute();
            }
            return true;
        } else {
            return false;
        }
    }
}