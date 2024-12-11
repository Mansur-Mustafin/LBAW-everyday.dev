<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class NewsPostFilter extends QueryFilter
{
    public function tags(array $tags): void
    {
        $this->builder->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('name', $tags);
        });
    }

    public function ranks(array $ranks): void
    {
        $this->builder->whereHas('author', function ($query) use ($ranks) {
            $query->whereIn('rank', $ranks);
        });
    }

    public function date_range(string $range): void
    {
        switch ($range) {
            case 'Last Day':
                $this->builder->where('created_at', '>=', now()->subDay());
                break;
            case 'Last Week':
                $this->builder->where('created_at', '>=', now()->subWeek());
                break;
            case 'Last Month':
                $this->builder->where('created_at', '>=', now()->subMonth());
                break;
            case 'Last Year':
                $this->builder->where('created_at', '>=', now()->subYear());
                break;
        }
    }

    public function order_by(string $sort): void
    {
        switch ($sort) {
            case 'Most upvoted':
                $this->builder->orderBy(DB::raw('upvotes - downvotes'), 'desc');
                break;

            case 'Sort by':
            case 'Most recent':
            default:
                $this->builder->orderBy('created_at', 'desc');
                break;
        }
    }
}
