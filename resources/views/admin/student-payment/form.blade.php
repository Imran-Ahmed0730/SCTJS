@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Payment
@endsection
@section('content')

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-center text-danger">{{session('message')}}</h3>
                    <h2><strong> @isset($item)Edit @else Add @endisset Payment Form</strong></h2>
                </div>
                <div class="card-body card-block">
                    <form action="@isset($item){{route('student.payment.update')}}@else{{route('student.payment.submit')}}@endisset" method="post">
                        @csrf
                        <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                        <div class="row mb-3">

                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-4"><label for="company" class=" form-control-label">Bill Date
                                    <span class="text-danger">*</span></label>
                                <input type="date" name="bill_date" id="company" class="form-control @error('bill_date') is-invalid @enderror"
                                       value="@isset($item){{$item->bill_date}}@else{{date('Y-m-d')}}@endisset" required>
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
                            <div class="form-group col-md-4"><label for="company" class=" form-control-label">Payment Date
                                    <span class="text-danger">*</span></label>
                                <input type="date" name="payment_date" id="company" class="form-control @error('payment_date') is-invalid @enderror"
                                       value="@isset($item){{$item->payment_date}}@else{{date('Y-m-d')}}@endisset" required>
                                @error('payment_date')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Payment Month
                                    <span class="text-danger">*</span></label>
                                <select name="payment_month" id="" class="form-control @error('payment_month') is-invalid @enderror" required>
                                    <option value="">Select Month</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{$i}}" @isset($item){{$item->payment_month == $i ? 'selected':''}}@endisset>{{$months[$i-1]}}</option>
                                    @endfor
                                </select>
                                @error('payment_month')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Payment Year
                                    <span class="text-danger">*</span></label>
                                <select name="payment_year" id="" class="form-control @error('payment_year') is-invalid @enderror" required>
                                    <option value="">Select Year</option>
                                    @for($i=2018; $i<=date('Y'); $i++)
                                        <option value="{{$i}}" @isset($item){{$item->payment_year == $i ? 'selected':''}}@endisset>{{$i}}</option>
                                    @endfor
                                </select>
                                @error('payment_year')
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
                            <div class="form-group col-md-6"><label for="company" class=" form-control-label">Amount
                                    <span class="text-danger">*</span></label>
                                <input type="number" name="amount" id="company" class="form-control @error('notice_title') is-invalid @enderror"
                                       value="@isset($item){{$item->amount}}@else{{old('amount')}}@endisset" @isset($item) readonly @else required @endisset>
                                @error('amount')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="" class="form-control-label">Comments</label>
                                <input type="text" name="comment" id="company" class="form-control"
                                       value="@isset($item){{$item->comment}}@else{{old('notice_title')}}@endisset">
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
        </div>
    </div>

@endsection

