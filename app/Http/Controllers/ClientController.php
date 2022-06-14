<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return ClientResource::collection(Client::whereCompany_id($request->input('company_id'))->whereStatus(true)->get());
    }
}
