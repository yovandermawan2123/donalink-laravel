<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role_id', 2)->get();
        return view('backend.member.index', [
            'members' => $members
        ]);
    }
    public function show($id)
    {
        $member = User::where('id', $id)->first();
        return view('backend.member.detail', [
            'member' => $member
        ]);
    }
}
