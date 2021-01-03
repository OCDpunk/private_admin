<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class GithubRepositories extends Model
{
    use HasFactory;

    protected $table = 'github_repositories';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name', 'full_name', 'description', 'owner', 'html_url', 'original_data',];

    /**
     * 作者资料访问器
     * @param $value
     * @return void
     */
    public function getOwnerAttribute($value)
    {
        return json_decode($value, true);
    }

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
