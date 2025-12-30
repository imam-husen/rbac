<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'category',
        'status',
        'tags',
        'featured_image',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the tags as an array
     */
    public function getTagsArrayAttribute()
    {
        if (!$this->tags) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Scope for published articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for draft articles
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope for archived articles
     */
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    /**
     * Scope for articles by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get excerpt of content
     */
    public function getExcerptAttribute($length = 150)
    {
        $content = strip_tags($this->content);
        
        if (strlen($content) > $length) {
            $content = substr($content, 0, $length) . '...';
        }
        
        return $content;
    }
}