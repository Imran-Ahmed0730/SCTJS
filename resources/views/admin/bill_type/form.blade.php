@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Bill Type
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Bill Type Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.bills.type.update')}}@else{{route('admin.bills.type.submit')}}@endisset" method="post">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Bill Title
                            <span class="text-danger">*</span></label>
                        <input type="text" name="bill_type_name" id="company" class="form-control @error('bill_type_name') is-invalid @enderror"
                               value="@isset($item){{$item->bill_type_name}}@else{{old('bill_type_name')}}@endisset" required>
                        @error('bill_type_name')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Bill Amount
                            <span class="text-danger">*</span></label>
                        <input type="number" id="company" name="bill_amount"
                               class="form-control @error('bill_amount') is-invalid @enderror"
                               value="@isset($item){{$item->bill_amount}}@else{{old('bill_amount')}}@endisset" required>
                        @error('bill_amount')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Billing Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

