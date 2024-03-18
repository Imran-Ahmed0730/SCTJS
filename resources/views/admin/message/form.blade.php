@extends('admin.master')
@section('title')
    @isset($item) Edit @else Send @endisset Message
@endsection
@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>@isset($item) Edit @else Send @endisset Message</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.message.submit')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-group col-md-6"><label for="" class="form-control-label">Date</label>
                                <input type="text" class="form-control" value="@isset($item){{$item->created_at}} @else{{date('d-m-Y')}}@endisset" readonly>
                            </div>
                            <div class="form-group col-md-6"><label for="" class="form-control-label">Recipient
                                <span class="text-danger">*</span></label>
                                <select name="branch_id" id="" class="form-control @error('message') is-invalid @enderror">
                                    <option value="0" @isset($item){{$item->branch_id == 0 ? 'selected':''}}@endisset>All Branches</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}" @isset($item){{$item->branch_id == $branch->id ? 'selected':''}}@endisset>
                                            {{$branch->branch_code}} ({{$branch->branch_name}})</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 form-group"><label for="" class="form-control-label">Message <span class="text-danger">*</span></label>
                                <input type="text" name="message" value="@isset($item){{$item->message}} @else {{old('message')}} @endisset"
                                       class="form-control @error('message') is-invalid @enderror">
                                @error('message')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary form-control">@isset($item) Update @else Send @endisset Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
