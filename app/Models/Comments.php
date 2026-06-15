<?php

namespace App\Models;   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Comments extends Model{
    use SoftDeletes;
    protected $fillable = ['id','Fk_userId', 'Fk_postId','parent_id','body'];

    public function post() { return $this->belongsTo(Post::class, 'Fk_postId'); }
    public function user() { return $this->belongsTo(User::class, 'Fk_userId'); }
    public function replies() { return $this->hasMany(Comments::class, 'parent_id'); }
    public function parent() { return $this->belongsTo(Comments::class, 'parent_id'); }
}