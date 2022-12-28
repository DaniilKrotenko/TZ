<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends AbstractFilter
{
    public const ID_CATEGORIE = 'id_categorie';
    public const PRICE = 'price';



    protected function getCallbacks(): array
    {
        return [
            self::ID_CATEGORIE => [$this, 'id_categorie'],
            self::PRICE => [$this, 'price'],
        ];
    }

    public function id_categorie(Builder $builder, $value)
    {

        $builder->where('id_categorie', $value);
    }

    public function price(Builder $builder, $value)
    {

        $builder->where('price', $value);
    }

}
