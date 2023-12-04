<?php

namespace App\Estate\Repositories;

use Carbon\Carbon;
use DB;
use App\Estate\Models\Unit;
use App\Estate\Interfaces\UnitInterface;

class UnitEloquent implements UnitInterface
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
    public function paginatedSearch($filter)
    {
        try {
            $query = new Unit();

            if (!empty($filter['per_page'])) {
                $perPage = $filter['per_page'];
            }

            if (!empty($filter['estate'])) {
                $query = $query->where('estate', $filter['estate']);
            }

            if (!empty($filter['label'])) {
                $query = $query->where('label', 'like', '%'.$filter['label'].'%');
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

    /**
     * Fetches a specified Unit by ID
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetch($id)
    {
        try {
            return Unit::with([
                    'community',
                    'owners',
                    'tenants',
                ])
                ->where('id', $id)
                ->first();

        } catch (\Exception $error) {
            dd($error->getMessage());
            return [];
        }
    }

}
