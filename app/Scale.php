<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Scale
 * @package App
 *
 *  * @SWG\Definition(
 *     definition="Scale",
 *     required={"monthly", "rate"},
 *     @SWG\Property(
 *          property="monthly",
 *          type="number",
 *          description="Monthly Gradation Scale",
 *          example="250000"
 *     ),
 *     @SWG\Property(
 *          property="rate",
 *          type="string",
 *          description="Monthly rate",
 *          example="7"
 *     )
 * )
 */
class Scale extends Model
{
    //
    protected $fillable = [
        'monthly',
        'rate'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
