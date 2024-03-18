@extends('admin.master')
@section('title')
    Edit Settings
@endsection
@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3><strong>Edit Settings Form</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.setting.update')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            @php $i=1 @endphp
                            @foreach($items as $item)
                                <div class="form-group col-md-6">
                                    <label for="" class="form-control-label">{{$item->key}}</label>
                                    @if($item->value == 1 || $item->value == 2)
                                        <select name="value[]" id="" class="form-control">
                                            <option value="1" {{$item->value == 1 ? 'selected':''}}>Active</option>
                                            <option value="2" {{$item->value == 2 ? 'selected':''}}>Inactive</option>
                                        </select>
                                    @else
                                        <input
                                            type="text" name="value[]" class="form-control" value="{{$item->value}}">
                                    @endif

                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary form-control">Update Settings</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
