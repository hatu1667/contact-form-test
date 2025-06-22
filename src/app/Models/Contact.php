<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGenderLabelAttribute()
    {
        switch ($this->gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '未設定';
        }
    }

    public function getCategoryLabelAttribute()
    {
    return optional($this->category)->content ?? '未設定';
    }

    protected static function newFactory()
    {
        return ContactFactory::new();
    }

}
