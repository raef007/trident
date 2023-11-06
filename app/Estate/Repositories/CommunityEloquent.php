<?php

namespace App\Estate\Repositories;

use Carbon\Carbon;
use DB;
use App\Estate\Models\Community;
use App\Estate\Interfaces\CommunityInterface;

class CommunityEloquent implements CommunityInterface
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
    public function paginatedSearch($filter)
    {
        try {
            $query = new Community();

            if (!empty($filter['per_page'])) {
                $perPage = $filter['per_page'];
            }

            if (!empty($filter['organization'])) {
                $query = $query->where('organization', $filter['organization']);
            }

            if (!empty($filter['name'])) {
                $query = $query->where('name', 'like', '%'.$filter['name'].'%');
            }

            if (!empty($filter['classification'])) {
                $query = $query->where('classification', $filter['classification']);
            }

            if (!empty($filter['city'])) {
                $query = $query->where('city', $filter['city']);
            }

            if (!empty($filter['state'])) {
                $query = $query->where('state', $filter['state']);
            }

            if (!empty($filter['country'])) {
                $query = $query->where('country', $filter['country']);
            }

            $countQuery = null;
            
            $countQuery = $query;
            $totalRows = $countQuery->count();
            $pageCount = 1;

            if (!empty($filter['page'])) {
                $pageCount = ceil($totalRows / $perPage);

                if ($filter['page'] == 1) {
                    $offset = 0;
                } else {
                    $offset = ($filter['page'] * $perPage) - $perPage;    
                }
                
                $query = $query->offset($offset)->limit($perPage);
            }

            if (!empty($filter['sort']) && !empty($filter['order'])) {
                $query = $query->orderBy($filter['sort'], $filter['order']);
            }

            return [
                'collection' => $query->get(),
                'total' => $totalRows,
                'pageCount' => $pageCount
            ];

        } catch (\Exception $error) {
            return [
                'collection' => [],
                'total' => 0,
                'pageCount' => 0
            ];
        }
    }

}
