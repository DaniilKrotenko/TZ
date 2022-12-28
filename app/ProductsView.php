<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Filterable;

class ProductsView extends Model
{
    use HasFactory;

    use Filterable;
    protected $guarded = false;
}
