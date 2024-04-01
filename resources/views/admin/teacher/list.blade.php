@extends('admin.master')
@section('title')
    Teacher List
@endsection

@section('content')
    @php
        use App\Models\Upazila;
        use App\Models\District;
        if (isset($_GET['district'])){
            $district = District::find($_GET['district']);
        }
        if (isset($_GET['upazila'])){
            $upazila = Upazila::find($_GET['upazila']);
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Teacher List</strong>
                        <a href="{{route('admin.teacher.add')}}" class="float-right btn btn-primary">Add Teacher</a></h3>
                    <hr>
                    {{--                    <form action="" id="filterForm">--}}
                    {{--                        <div class="row mb-4">--}}
                    {{--                            <div class="form-group col-sm-3">--}}
                    {{--                                <label for="" class="form-control-label">Name</label>--}}
                    {{--                                <input type="text" name="branch" class="form-control" onkeyup="filter()" placeholder="Enter Branch Name or Branch Code" value="@if (isset($_GET['branch']) && $_GET['branch']>0){{$_GET['branch']}} @endif">--}}
                    {{--                            </div>--}}
                    {{--                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch Division</label>--}}
                    {{--                                <select name="division" onchange="filter()" id="division_id" class="form-control">--}}
                    {{--                                    <option value="">All</option>--}}
                    {{--                                    @foreach($divisions as $division)--}}
                    {{--                                        <option value="{{$division->id}}"--}}
                    {{--                                        @isset($_GET['division']){{$_GET['division'] == $division->id ? 'selected': ''}}@endisset>--}}
                    {{--                                            {{$division->name}}</option>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </select>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch District</label>--}}
                    {{--                                <select name="district" onchange="filter()" id="district_id" class="form-control">--}}
                    {{--                                    <option value="">All</option>--}}
                    {{--                                    @if(isset($_GET['division']) && $_GET['division'] >0)--}}
                    {{--                                        @foreach($districts as $district)--}}
                    {{--                                            <option value="{{$district->id}}" @isset($_GET['district']){{$_GET['district'] == $district->id ? 'selected': ''}}@endisset>{{$district->name}}</option>--}}
                    {{--                                        @endforeach--}}
                    {{--                                    @endif--}}
                    {{--                                        <option value="{{$_GET['district']}}"--}}
                    {{--                                                @isset($_GET['district']) selected @endisset--}}
                    {{--                                        >{{$district->name}}</option>--}}

                    {{--                                </select>--}}

                    {{--                            </div>--}}
                    {{--                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch Upazila</label>--}}
                    {{--                                <select name="upazila" onchange="filter()" id="upazila_id" class="form-control">--}}
                    {{--                                    <option value="">All</option>--}}
                    {{--                                    @if(isset($_GET['district']) && $_GET['district']>0)--}}
                    {{--                                        @foreach($upazilas as $upazila)--}}
                    {{--                                            <option value="{{$upazila->id}}" @isset($_GET['upazila']){{$_GET['upazila'] == $upazila->id ? 'selected': ''}}@endisset>{{$upazila->name}}</option>--}}
                    {{--                                        @endforeach--}}
                    {{--                                    @endisset--}}
                    {{--                                    @isset($_GET['upazila'])--}}
                    {{--                                        <option value="{{$_GET['upazila']}}" selected>{{$upazila->name}}</option>--}}
                    {{--                                    @endisset--}}
                    {{--                                </select>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </form>--}}
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
{{--                            <th>Assigned Course<br><span class="second-line">Batch</span></th>--}}
                            <th>Designationa</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @php $i=1; @endphp
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><img src="{{asset($item->image)}}" alt="" height="50px" width="50px"></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
{{--                                <td>{{$item->course_id ?? 'N/A'}} <br><span>{{$item->batch_id ?? ''}}</span></td>--}}
                                <td>{{$item->designation}}</td>
                                <td>{{$item->join_date}}</td>
                                <td class="text-center">
                                    <div class="mt-2">
                                        <span class="{{$item->status == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->registration_status_id == 1 ? 'Active':'Inactive'}}</span>
                                    </div>
                                </td>

                                <td class="btn-group">
                                    <a href="{{route('admin.teacher.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.teacher.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" title="Remove" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{--    <script>--}}
    {{--        jQuery( document ).ready(function() {--}}
    {{--            // alert('okay');--}}
    {{--            jQuery('#division_id').change(function(){--}}
    {{--                var division_id = jQuery(this).val();--}}
    {{--                var url = '{{ route("admin.branch.get-district-by-division", ":division_id") }}';--}}
    {{--                url = url.replace(':division_id',division_id);--}}

    {{--                if(division_id!='0'){--}}
    {{--                    jQuery.ajax({--}}
    {{--                        url: url,--}}
    {{--                        dataType: 'json',--}}
    {{--                        beforeSend: function() {--}}
    {{--                            //jQuery('select[name=\'division_id\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');--}}
    {{--                        },--}}
    {{--                        complete: function() {--}}
    {{--                            jQuery('.wait').remove();--}}
    {{--                        },--}}
    {{--                        success: function(json) {--}}
    {{--                            html = '<option value="">--Select--</option>';--}}
    {{--                            for (i = 0; i < json.length; i++) {--}}
    {{--                                html += '<option value="' + json[i]['id'] + '"';--}}
    {{--                                html += '>' + json[i]['name'] + '</option>';--}}
    {{--                            }--}}

    {{--                            jQuery('select[name=\'district\']').html(html);--}}
    {{--                            html_upazila = '<option value="">--Select--</option>';--}}
    {{--                            jQuery('select[name=\'upazila\']').html(html_upazila);--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                }else if(division_id=='0'){--}}
    {{--                    html_upazila = '<option value="">--Select--</option>';--}}
    {{--                    jQuery('select[name=\'district\']').html(html_upazila);--}}
    {{--                    jQuery('select[name=\'upazila\']').html(html_upazila);--}}
    {{--                }--}}

    {{--            });--}}

    {{--            jQuery('#district_id').change(function(){--}}
    {{--                var district_id = jQuery(this).val();--}}
    {{--                var url = '{{ route("admin.branch.get-upazila-by-district", ":district_id") }}';--}}
    {{--                url = url.replace(':district_id',district_id);--}}

    {{--                if(district_id>0){--}}
    {{--                    jQuery.ajax({--}}
    {{--                        url: url,--}}
    {{--                        dataType: 'json',--}}
    {{--                        beforeSend: function() {--}}
    {{--                            // jQuery('select[name=\'district\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');--}}
    {{--                        },--}}
    {{--                        complete: function() {--}}
    {{--                            jQuery('.wait').remove();--}}
    {{--                        },--}}
    {{--                        success: function(json) {--}}
    {{--                            html = '<option value="">--Select--</option>';--}}
    {{--                            for (i = 0; i < json.length; i++) {--}}
    {{--                                html += '<option value="' + json[i]['id'] + '"';--}}
    {{--                                html += '>' + json[i]['name'] + '</option>';--}}
    {{--                            }--}}
    {{--                            jQuery('select[name=\'upazila\']').html(html);--}}
    {{--                        }--}}
    {{--                    });--}}
    {{--                }else{--}}
    {{--                    html = '<option value="">--Select--</option>';--}}
    {{--                    jQuery('select[name=\'upazila\']').html(html);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector("#img").setAttribute("src",e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        jQuery(document).ready( function () {
            jQuery('#myTable').DataTable();
        } );
    </script>

@endpush
