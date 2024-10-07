<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:2|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:10|integer',
            'daily_balance' => 'required|integer',
            'join_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Create Member
        $member = Member::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'daily_balance' => $request->daily_balance,
            'join_date' => $request->join_date,
        ]);

        //Total Due
        $member->savings()->create([
            'total_due' => $member->calculateTotalAmount()
        ]);

        if ($member) {
            return redirect()->route('member.index')->with('success', 'Insert New Member Successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to Insert!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:2|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:10|integer',
            'join_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $member = $member->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'join_date' => $request->join_date,
        ]);

        if ($member) {
            return redirect()->route('member.index')->with('success', 'Update New Member Successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to Update!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member = $member->delete();
        if ($member) {
            return redirect()->route('member.index')->with('success', 'Deleted Member Successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to Delete!!!');
        }
    }
}
