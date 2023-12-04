<?php

namespace App\User\Repositories;

use Carbon\Carbon;
use DB;
use App\Models\User;
use App\User\Interfaces\UserInterface;

class UserEloquent implements UserInterface
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
    public function paginatedSearch($filter)
    {
        try {
            $query = new User();

            if (!empty($filter['per_page'])) {
                $perPage = $filter['per_page'];
            }

            if (!empty($filter['organization'])) {
                $query = $query->where('organization', $filter['organization']);
            }

            if (!empty($filter['name'])) {
                $query = $query->where('name', 'like', '%'.$filter['name'].'%');
            }

            if (!empty($filter['email'])) {
                $query = $query->where('email', 'like', '%'.$filter['email'].'%');
            }

            if (!empty($filter['role'])) {
                $query = $query->where('role', $filter['role']);
            }

            if (!empty($filter['except'])) {
                $query = $query->whereNot('id', $filter['except']);
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
     * Fetches a specified User by ID
     *
     * @param integer $id
     *
     * @return array
     */
    public function fetch($id)
    {
        try {
            return User::with([
                    'profile'
                ])
                ->where('id', $id)
                ->first();

        } catch (\Exception $error) {
            dd($error->getMessage());
            return [];
        }
    }
}
