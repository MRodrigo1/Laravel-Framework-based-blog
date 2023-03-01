<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //Only title is able to be mass assigned
    protected $fillable =['title','excerpt','body'];
    //Proteger o id de ser assigned, ignora mesmo se for passado o id
    //protected $guarded = ['id'];

    //default para todas as post querrys
    protected $with = ['category','author'];

    public function scopeFilter($query,array $filters){
        //     if($filters['search'] ?? false){
        //         $query
        //         ->where('title','like','%' . request('search').'%')
        //         ->orWhere('body','like','%' . request('search').'%');
        // }
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            );
        }
    );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            // mudar para function e adicionar {}    
            // $query
            //     ->whereExists(fn($query) =>
            //     $query->from('categories')
            //             ->whereColumn('categories.id','posts.category_id')
            //             ->where('categories.slug',$category)
            // );
            $query->whereHas('category',fn($query)=>$query->where('slug',$category)
            )
        );
        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas('author', fn($query)=>
            $query->where('username',$author));
        });
    }

    //Ou disable mass assign
    //protected $guarded = [];

    public function comments() //author_id -> foreign_key
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author() //author_id -> foreign_key
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
