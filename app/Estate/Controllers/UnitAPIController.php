<?php

namespace App\Estate\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Estate\Models\Unit;
use App\Estate\Interfaces\UnitInterface;

/**
 * REST API for Unit
 * Endpoints for Unit are routed to this class
 */
class UnitAPIController extends Controller
{
    protected $unitRepository;
    
    public function __construct(UnitInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }
    
    public function index(Request $request)
    {
        return $this->filtered($request);
    }

    private function filtered(Request $request)
    {
        $filter = [];
        $filter['page'] = ($request->has('page')) ? $request->query('page') : 0;
        $filter['per_page'] = ($request->has('per_page')) ? $request->query('per_page') : 10;
        $filter['sort'] = ($request->has('sort')) ? $request->query('sort') : 'created_at';
        $filter['order'] = ($request->has('order')) ? $request->query('order') : 'DESC';

        $filter['estate'] = ($request->has('estate')) ? $request->query('estate') : 0;
        $filter['label'] = ($request->has('label')) ? $request->query('label') : '';

        try {
            $units = $this->unitRepository->paginatedSearch($filter);

            return new Response(
                [
                    "message" => ['Success'],
                    "collection" => $units['collection'],
                    "pagination" => [
                        'total' => $units['total'],
                        'page' => $filter['page'],
                        'pageCount' => $units['pageCount']
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

    public function show(Request $request, $id)
    {
        try {
            $unit = $this->unitRepository->fetch($id);

            return new Response(
                [
                    "message" => ['Success'],
                    "resource" => $unit,
                ], 200
            );
        } catch (\Exception $error) {
            return new Response(
                [
                    "message" => [$error->getMessage()],
                    "resource" => null,
                ], 500
            );
        }
    }
}
