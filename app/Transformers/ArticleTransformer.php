<?php

namespace App\Transformers;

use App\Article;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class ArticleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

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
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'author_id' => $article->author_id,
            'title' => $article->title,
            'slug' => $article->slug,
            'body' => $article->body,
            'created_at' => $article->created_at->format('d M Y'),
            'updated_at' => $article->updated_at->format('d M Y')			
        ];
    }

    public function includeAuthor(Article $article){
        return $this->item($article->author, new UserTransformer);
    }
}
