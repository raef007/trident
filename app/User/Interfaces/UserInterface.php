<?php

namespace App\User\Interfaces;

use App\Models\User;

interface UserInterface
{
    /**
     * Fetch Users according to Filtered parameters
     * 
     * Filters:
     *  ['except'] - Except User
     *  ['organization'] - Organization
     *  ['name'] - Name
     *  ['email'] - Email
     *  ['role'] - Role
     *  ['page'] - The Page Number for pagination
     *  ['per_page'] - Number of records per Page
     *  ['sort'] - Sort by a column
     *  ['order'] - Order Direction
     *
     * @param array $filter
     * @return array['collection', 'total', pageCount]
     */
    public function paginatedSearch($filter);

}