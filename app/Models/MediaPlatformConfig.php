<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class MediaPlatformConfig extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';

    protected $table = 'media_platform_config';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['code', 'account_appid', 'account_secret', 'account_token', 'account_aes_key', 'more', 'remark'];

    /**
     * 拓展字段访问器
     * @param $value
     * @return void
     */
    public function getMoreAttribute($value)
    {
        return json_decode($value, true);
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
