@extends('admin.master')
@section('title')
    Branch List
@endsection



@section('content')
    @php
    use App\Models\Upazila;
    use App\Models\District;
    if (isset($_GET['branch_district'])){
        $district = District::find($_GET['branch_district']);
    }
    if (isset($_GET['branch_upazila'])){
        $upazila = Upazila::find($_GET['branch_upazila']);
    }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Branch List</strong>
                        <a href="{{route('admin.branch.add')}}" class="float-right btn btn-primary">Add Branch</a></h3>
                    <hr>
                    <form action="" id="filterForm">
                        <div class="row mb-4">
                            <div class="form-group col-sm-3">
                                <label for="" class="form-control-label">Branch Name or Code</label>
                                <input type="text" name="branch" class="form-control" onchange="filter()" placeholder="Enter Branch Name or Branch Code" value="@if (isset($_GET['branch']) && $_GET['branch']>0){{$_GET['branch']}} @endif">
                            </div>
                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch Division</label>
                                <select name="branch_division" onchange="filter()" id="division_id" class="form-control">
                                    <option value="">All</option>
                                    @foreach($divisions as $division)
                                        <option value="{{$division->id}}"
                                        @isset($_GET['branch_division']){{$_GET['branch_division'] == $division->id ? 'selected': ''}}@endisset>
                                            {{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch District</label>
                                <select name="branch_district" onchange="filter()" id="district_id" class="form-control">
                                    <option value="">All</option>
                                    @if(isset($_GET['branch_division']) && $_GET['branch_division'] >0)
                                        @foreach($districts as $district)
                                            <option value="{{$district->id}}" @isset($_GET['branch_district']){{$_GET['branch_district'] == $district->id ? 'selected': ''}}@endisset>{{$district->name}}</option>
                                        @endforeach
                                    @endif
{{--                                        <option value="{{$_GET['branch_district']}}"--}}
{{--                                                @isset($_GET['branch_district']) selected @endisset--}}
{{--                                        >{{$district->name}}</option>--}}

                                </select>

                            </div>
                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch Upazila</label>
                                <select name="branch_upazila" onchange="filter()" id="upazila_id" class="form-control">
                                    <option value="">All</option>
                                    @if(isset($_GET['branch_district']) && $_GET['branch_district']>0)
                                        @foreach($upazilas as $upazila)
                                            <option value="{{$upazila->id}}" @isset($_GET['branch_upazila']){{$_GET['branch_upazila'] == $upazila->id ? 'selected': ''}}@endisset>{{$upazila->name}}</option>
                                        @endforeach
                                    @endisset
{{--                                    @isset($_GET['branch_upazila'])--}}
{{--                                        <option value="{{$_GET['branch_upazila']}}" selected>{{$upazila->name}}</option>--}}
{{--                                    @endisset--}}
                                </select>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name<br><span class="second-line">Code</span></th>
                                <th>Email<br><span class="second-line">Phone</span></th>
                                <th>Division<br><span class="second-line">District</span></th>
                                <th>Upazila<br><span class="second-line">Area</span></th>
                                <th>Type<br><span class="second-line">Join Date</span></th>
                                <th>Total Students<br><span class="second-line">Registration Status</span></th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        @php $i=1; @endphp
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->branch_name}}<br><span class="text-info">{{$item->branch_code}}</span></td>
                                <td>{{$item->branch_email}}<br><span>{{$item->branch_phone}}</span></td>
                                <td>{{$item->division->name}}<br><span>{{$item->district->name}}</span></td>
                                <td>{{$item->upazila->name}} <br><span>{{$item->branch_area}}</span></td>
                                <td>{{$item->branch_type_id == 1 ? 'Head Branch':'Branch'}}<br><span>{{$item->join_date}}</span></td>
                                <td class="text-center">{{count(getStudentsByBranchId($item->id))}}<br>
                                    <div class="mt-2">
                                        <span class="{{$item->registration_status_id == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->registration_status_id == 1 ? 'Active':'Inactive'}}</span>
                                    </div>
                                </td>

                                <td class="btn-group">
                                    <a href="{{route('admin.branch.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.branch.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
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

{{--                            jQuery('select[name=\'branch_district\']').html(html);--}}
{{--                            html_upazila = '<option value="">--Select--</option>';--}}
{{--                            jQuery('select[name=\'branch_upazila\']').html(html_upazila);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }else if(division_id=='0'){--}}
{{--                    html_upazila = '<option value="">--Select--</option>';--}}
{{--                    jQuery('select[name=\'branch_district\']').html(html_upazila);--}}
{{--                    jQuery('select[name=\'branch_upazila\']').html(html_upazila);--}}
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
{{--                            // jQuery('select[name=\'branch_district\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');--}}
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
{{--                            jQuery('select[name=\'branch_upazila\']').html(html);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }else{--}}
{{--                    html = '<option value="">--Select--</option>';--}}
{{--                    jQuery('select[name=\'branch_upazila\']').html(html);--}}
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
