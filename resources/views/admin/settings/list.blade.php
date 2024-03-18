@extends('admin.master')
@section('title')
    View Settings
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="text-success ">{{session('message')}}</h4>
                    <h3>View Settings</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Setting Name</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->key}}</td>
                                <td>
                                    @if($item->value == 1)
                                        <span class="p-2 bg-success" style="border-radius: 8px">
                                    Active
                                </span>
                                    @elseif($item->value == 2)
                                        <span class="p-2 bg-danger" style="border-radius: 8px">
                                    Inactive
                                </span>
                                    @else
                                        {{$item->value}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
