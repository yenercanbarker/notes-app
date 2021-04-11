<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ToDoList extends Model
{
    use HasFactory;

    public $table = 'to_do_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    public function notes() {
        return $this->belongsToMany(Note::class)->withTimeStamps();
    }

    public static function allLists() {
        return User::find(Auth::id())->to_do_lists()->paginate(12);
    }

    public static function getList($listId) {
        return User::find(Auth::id())->to_do_lists()->with(['notes'])->where('to_do_list_id', '=', $listId)->first();
    }
}
