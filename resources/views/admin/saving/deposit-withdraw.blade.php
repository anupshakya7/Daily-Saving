@extends('admin.layout.web')
@section('content')
<section>
    <div class="my-3">
        <h3 class="d-inline">{{ $type == 'deposit' ? 'Deposit':'Withdraw'}} Member: {{$member->fullname}}</h3>
    </div>
    <div class="card p-3">
        <form action="{{route('saving.depositwithdraw.submit',$member)}}" method="POST">
            @csrf
            <input type="hidden" name="type" value="{{$type}}">
            <div class="mb-3">
                <label for="member" class="form-label">Member</label>
                <input type="text" class="form-control" name="member" value="{{old('member',$member->fullname)}}"
                    id="member" placeholder="Member" readonly>
                @error('member')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deposit" class="form-label">{{ $type == 'deposit' ? 'Deposit':'Withdraw'}} Amount</label>
                <input type="number" class="form-control" name="deposit" id="deposit" value="{{old('deposit')}}"
                    placeholder="{{ $type == 'deposit' ? 'Deposit':'Withdraw'}} Amount">
                @error('deposit')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>

@endsection