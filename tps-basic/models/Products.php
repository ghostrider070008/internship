<?php


namespace app\models;


class Products extends ProductsBase
{
    public $count;

    public function rules()
    {
        return array_merge([
            ['count', 'integer'],
            ['type', 'integer'],
        ],
            parent::rules()
        );
    }
}