<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return CompanyResource::collection(Company::all());
    }
}
