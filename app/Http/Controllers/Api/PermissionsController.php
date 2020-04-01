<?php

/*
 * @author weifan
 * Wednesday 1st of April 2020 10:25:59 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $permissions = $request->user()->getAllPermissions();

        PermissionResource::wrap('data');

        return PermissionResource::collection($permissions);
    }
}
