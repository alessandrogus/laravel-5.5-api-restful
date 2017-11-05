<?php

namespace App\Transformers;

use App\User;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['articles'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(User $user)
    {
        return [

            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
			
        ];
    }

    public function includeArticles(User $user){
        return $this->Collection($user->articles, new ArticleTransformer);
    }
}
