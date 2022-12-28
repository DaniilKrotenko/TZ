<?php

namespace App;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    use HasFactory;

    use Filterable;
    protected $guarded = false;

}
