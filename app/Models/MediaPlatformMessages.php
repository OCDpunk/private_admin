<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class MediaPlatformMessages extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';

    protected $table = 'media_platform_messages';

    protected $fillable = ['media_platform_name', 'media_platform_code', 'to_user_name', 'from_user_name', 'create_time', 'msg_type', 'msg_id', 'content', 'media_id',
        'pic_url', 'format', 'recognition', 'thumb_media_id', 'location_x', 'location_y', 'scale', 'label', 'title', 'description',
        'url', 'original_data', 'created_at', 'updated_at'
    ];

    /**
     * 原始数据访问器
     * @param $value
     * @return void
     */
    public function getOriginalDataAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * 创建时间修改器
     * @param $value
     * @return void
     */
    public function setCreateTimeAttribute($value)
    {
        $this->attributes['create_time'] = (int)$value;
    }

    /**
     * 创建时间访问器
     * @param $value
     * @return void
     */
    public function getCreateTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
