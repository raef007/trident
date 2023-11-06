<?php

namespace App\Estate\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Estate\Models\Community;
use App\Estate\Interfaces\CommunityInterface;

/**
 * REST API for Community
 * Endpoints for Community are routed to this class
 */
class APIController extends Controller
{
    protected $communityRepository;
    
    public function __construct(CommunityInterface $communityRepository)
    {
        $this->communityRepository = $communityRepository;
    }
    
    public function index(Request $request)
    {
        return $this->filtered($request);
    }

    public function me(Request $request)
    {
        return $this->filtered($request, true);
    }

    private function filtered(Request $request, $isUser=false)
    {
        $filter = [];
        $filter['page'] = ($request->has('page')) ? $request->query('page') : 0;
        $filter['per_page'] = ($request->has('per_page')) ? $request->query('per_page') : 10;
        $filter['sort'] = ($request->has('sort')) ? $request->query('sort') : 'created_at';
        $filter['order'] = ($request->has('order')) ? $request->query('order') : 'DESC';

        $filter['organization'] = ($request->has('organization')) ? $request->query('organization') : 0;
        $filter['name'] = ($request->has('name')) ? $request->query('name') : '';
        $filter['classification'] = ($request->has('classification')) ? $request->query('classification') : '';
        $filter['city'] = ($request->has('city')) ? $request->query('city') : '';
        $filter['state'] = ($request->has('state')) ? $request->query('state') : '';
        $filter['country'] = ($request->has('country')) ? $request->query('country') : '';

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
            $communities = $this->communityRepository->paginatedSearch($filter);

            return new Response(
                [
                    "message" => ['Success'],
                    "collection" => $communities['collection'],
                    "pagination" => [
                        'total' => $communities['total'],
                        'page' => $filter['page'],
                        'pageCount' => $communities['pageCount']
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
