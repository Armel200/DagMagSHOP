<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'quantity',
        'views',
        'status',
        'image',
        'category_id',
    ];

    // 🔸 Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔸 Relation avec le créateur (utilisateur)
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔸 Relation avec les likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // 🔸 Vérifie si un utilisateur a liké ce produit
    public function isLikedBy($user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
