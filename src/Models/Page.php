<?php

namespace EscolaLms\Pages\Models;

use EscolaLms\Core\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Page",
 *     required={"slug","title","author_id"},
 *     @OA\Property(
 *          property="slug",
 *          type="string",
 *     ),
 *     @OA\Property(
 *          property="title",
 *          type="string"
 *     ),
 *     @OA\Property(
 *         property="author_id",
 *         description="author_id",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *          property="content",
 *          type="string"
 *     ),
 * )
 */
class Page extends Model
{
    use HasFactory;

    public $table = 'pages';
    public $timestamps = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'title' => 'string',
        'author_id' => 'integer',
        'content' => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
