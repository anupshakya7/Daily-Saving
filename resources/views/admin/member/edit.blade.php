@extends('admin.layout.web')
@section('content')
<section>
    <div class="my-3">
        <h3 class="d-inline">Member</h3>
        <a href="{{route('member.index')}}" class="btn btn-primary float-end">Back</a>
    </div>
    <div class="card p-3">
        <form action="{{route('member.update',$member)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullname" value="{{old('fullname',$member->fullname)}}"
                    id="fullname" placeholder="Full Name">
                @error('fullname')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email',$member->email)}}"
                    placeholder="Email Address">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" name="phone" id="phone"
                    value="{{old('phone',$member->phone)}}" placeholder="Phone">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="join_date" class="form-label">Join Date</label>
                <input type="date" class="form-control" name="join_date" value="{{old('join_date',$member->join_date)}}"
                    id="join_date">
                @error('join_date')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>

@endsection