@extends('admin.layout.web')
@section('content')
<section>
    <div class="my-3">
        <h3 class="d-inline">Saving</h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fullname</th>
                <th scope="col">Remaining Balance</th>
                <th scope="col">Total Due</th>
                <th scope="col">Join Date</th>
                <th scope="col" width="200">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $key => $member)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$member->fullname}}</td>
                <td>{{!empty($member->savings->deposit_balance) ?
                    ($member->savings->total_due - $member->savings->deposit_balance):$member->savings->total_due}}</td>
                <td>{{$member->savings->total_due}}</td>
                <td>{{\Carbon\Carbon::parse($member->join_date)->format('F d, Y')}}</td>
                <td>
                    <a href="{{route('saving.deposit',$member)}}" class="btn btn-primary d-inline">Deposit</a>
                    <a href="" class="btn btn-success d-inline">Withdraw</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection