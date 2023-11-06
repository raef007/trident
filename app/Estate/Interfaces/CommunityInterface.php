<?php

namespace App\Estate\Interfaces;

use App\Estate\Models\Community;

interface CommunityInterface
{
    /**
     * Fetch Estate according to Filtered parameters
     * 
     * Filters:
     *  ['organization'] - Organization
     *  ['name'] - Name
     *  ['classification'] - Classification
     *  ['city'] - City
     *  ['state'] - State
     *  ['country'] - Country
     *  ['per_page'] - Number of records per Page
     *  ['sort'] - Sort by a column
     *  ['order'] - Order Direction
     *
     * @param array $filter
     * @return array['collection', 'total', pageCount]
     */
    public function paginatedSearch($filter);

}