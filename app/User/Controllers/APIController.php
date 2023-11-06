<?php

namespace App\User\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\User\Interfaces\UserInterface;

/**
 * REST API for User
 * Endpoints for Users are routed to this class
 */
class APIController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return $this->filterUsers($request);
    }

    public function me(Request $request)
    {
        return $this->filterUsers($request, true);
    }
    
    private function filterUsers(Request $request, $isUser=false)
    {
        $filter = [];
        $filter['page'] = ($request->has('page')) ? $request->query('page') : 0;
        $filter['per_page'] = ($request->has('per_page')) ? $request->query('per_page') : 10;
        $filter['sort'] = ($request->has('sort')) ? $request->query('sort') : 'created_at';
        $filter['order'] = ($request->has('order')) ? $request->query('order') : 'DESC';
        $filter['except'] = 0;

        $filter['organization'] = ($request->has('organization')) ? $request->query('organization') : 0;
        $filter['name'] = ($request->has('name')) ? $request->query('name') : '';
        $filter['email'] = ($request->has('email')) ? $request->query('email') : '';
        $filter['role'] = ($request->has('role')) ? $request->query('role') : '';

        if ($request->user()) {
            $filter['except'] = $request->user()->id;
        }

        if ($isUser) {
            if (!$request->user()) {
                return new Response(
                [
                    "message" => ['Permission denied'],
                    "collection" => null,
                    "pagination" => null,
                ], 500
            );
            }

            $filter['organization'] = $request->user()->organization;
        }

        try {
            $users = $this->userRepository->paginatedSearch($filter);

            return new Response(
                [
                    "message" => ['Success'],
                    "collection" => $users['collection'],
                    "pagination" => [
                        'total' => $users['total'],
                        'page' => $filter['page'],
                        'pageCount' => $users['pageCount']
                    ]
                ], 200
            );
        } catch (\Exception $error) {
            return new Response(
                [
                    "message" => [$error->getMessage()],
                    "collection" => null,
                    "pagination" => null,
                ], 500
            );
        }
    }
    
}
