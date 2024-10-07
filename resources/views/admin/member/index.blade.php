@extends('admin.layout.web')
@section('content')
<section>
    <div class="my-3">
        <h3 class="d-inline">Member</h3>
        <a href="{{route('member.create')}}" class="btn btn-primary float-end">Add Member</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fullname</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Daily Balance</th>
                <th scope="col">Join Date</th>
                <th scope="col" width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $key=>$member)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$member->fullname}}</td>
                <td>{{$member->phone}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->daily_balance}}</td>
                <td>{{ \Carbon\Carbon::parse($member->join_date)->format('F d,Y')}}</td>
                <td>
                    <a href="{{route('member.edit',$member)}}" class="btn btn-primary d-inline">Edit</a>
                    <form action="{{route('member.destroy',$member)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection