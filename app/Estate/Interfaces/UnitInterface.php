<?php

namespace App\Estate\Interfaces;

use App\Estate\Models\Unit;

interface UnitInterface
{
    /**
     * Fetch Estate according to Filtered parameters
     * 
     * Filters:
     *  ['estate'] - Community
     *  ['label'] - Label
     *  ['per_page'] - Number of records per Page
     *  ['sort'] - Sort by a column
     *  ['order'] - Order Direction
     *
     * @param array $filter
     * @return array['collection', 'total', pageCount]
     */
    public function paginatedSearch($filter);

}