<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
class Servers extends Model
{
    use HasFactory;

    protected $table = 'servers';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'name', 'server_website', 'ip', 'port', 'username', 'password', 'expire_date', 'control_panel_website', 'control_panel_username',
        'control_panel_password', 'remark', 'created_at', 'updated_at'
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
