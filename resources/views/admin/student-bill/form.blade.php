@extends('admin.master')
@section('title')
    Add Bill
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-center text-danger">{{session('message')}}</h3>
                    <h2><strong> @isset($item)Edit @else Add @endisset Bill Form</strong></h2>
                </div>
                <div class="card-body card-block">
                    <form action="{{route('student.bill.submit')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-group col-md-4"><label for="company" class=" form-control-label">Bill Date
                                    <span class="text-danger">*</span></label>
                                <input type="date" name="bill_date" id="company" class="form-control @error('bill_date') is-invalid @enderror"
                                       value="@isset($item){{$item->payment_date}}@else{{date('Y-m-d')}}@endisset" required>
                                @error('bill_date')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Bill Month
                                <span class="text-danger">*</span></label>
                                <select name="bill_month" id="" class="form-control @error('bill_month') is-invalid @enderror" required>
                                    <option value="">Select Month</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{$i}}" @isset($item){{$item->bill_month == $i ? 'selected':''}}@endisset>{{$months[$i-1]}}</option>
                                    @endfor
                                </select>
                                @error('bill_month')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Bill Year
                                    <span class="text-danger">*</span></label>
                                <select name="bill_year" id="" class="form-control @error('bill_year') is-invalid @enderror" required>
                                    <option value="">Select Year</option>
                                    @for($i=2018; $i<=date('Y'); $i++)
                                        <option value="{{$i}}" @isset($item){{$item->bill_year == $i ? 'selected':''}}@endisset>{{$i}}</option>
                                    @endfor
                                </select>
                                @error('bill_year')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-6"><label for="company" class=" form-control-label">Student Roll
                                <span class="text-danger">*</span></label>
                                <input type="number" id="company" name="student_roll"
                                       class="form-control @error('student_roll') is-invalid @enderror" value="@isset($item){{$item->student_roll}}@endisset"
                                       @isset($item) readonly @else required @endisset>
                                @error('student_roll')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6"><label for="" class="form-control-label">Bill Type<span
                                        class="text-danger">*</span></label>
                                <select name="bill_type_id" id="" class="form-control @error('bill_type_id') is-invalid @enderror">
                                    <option value="">Select Bill</option>
                                    @foreach($bill_types as $bill)
                                        <option value="{{$bill->id}}">{{$bill->bill_type_name}}</option>
                                    @endforeach
                                </select>
                                @error('bill_type_id')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="" class="form-control-label">Comments</label>
                                <input type="text" name="comments" id="company" class="form-control"
                                       value="@isset($item){{$item->comments}}@else{{old('notice_title')}}@endisset">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12">
                                <label for="" class="form-control-label"></label>
                                <button type="submit" class="btn btn-primary form-control">Add Billing Information</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endpush

