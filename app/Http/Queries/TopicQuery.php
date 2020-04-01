<?php

/*
 * @author weifan
 * Tuesday 31st of March 2020 08:09:03 PM
 */

namespace App\Http\Queries;

use App\Models\Topic;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TopicQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Topic::query());

        $this->allowedIncludes('user', 'user.roles', 'category')
             ->allowedFilters([
                 'titile',
                 AllowedFilter::exact('category_id'),
                 AllowedFilter::scope('withOrder')->default('recentReplied'),
             ]);
    }
}
