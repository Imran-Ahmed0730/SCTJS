@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Payment
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Payment Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.branch.payment.update')}}@else{{route('admin.branch.payment.submit')}}@endisset" method="post">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Payment Date</label>
                        <input type="text" name="payment_date" id="company" class="form-control"
                               value="@isset($item){{$item->payment_date}}@else{{date('d M, Y')}}@endisset" readonly>
                    </div>
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Branch
                            <span class="text-danger">*</span></label>
                        <select name="branch_id" id="" class="form-control @error('branch_id') is-invalid @enderror" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}" @isset($item){{$item->branch_id == $branch->id ? 'selected': ''}}@endisset>{{$branch->branch_code}} ({{$branch->branch_name}})</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Payment Amount
                            <span class="text-danger">*</span></label>
                        <input type="number" name="payment" id="company" class="form-control @error('payment') is-invalid @enderror"
                               value="@isset($item){{$item->payment}}@else{{old('payment')}}@endisset" @isset($item) readonly @else required @endisset>
                        @error('payment')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6"><label for="" class="form-control-label">Comments</label>
                        <input type="text" name="comments" class="form-control" value="@isset($item){{$item->comments}}@else{{old('comments')}}@endisset">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Payment Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

