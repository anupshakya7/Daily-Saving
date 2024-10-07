<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::with('savings')->get();
        return view('admin.saving.index', compact('members'));
    }

    //Deposit
    public function deposit(Member $member)
    {
        return view('admin.saving.deposit', compact('member'));
    }

    //Deposit Store
    public function depositSubmit(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'deposit' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $deposit_amount = !empty($member->savings->sum('deposit_balance')) ? ($member->savings->sum('deposit_balance') + $request->deposit) : $request->deposit;

        $deposit = $member->savings()->update([
            'deposit_balance' => $deposit_amount
        ]);

        if ($deposit) {
            return redirect()->route('saving.index')->with('success', 'Deposit Amount Successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to Deposit!!!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show(Saving $saving)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function edit(Saving $saving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saving $saving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saving $saving)
    {
        //
    }
}
