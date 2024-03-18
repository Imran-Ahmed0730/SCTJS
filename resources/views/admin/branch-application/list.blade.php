@extends('admin.master')
@section('title')
    Branch Application List
@endsection
@section('content')
{{--    @php--}}
{{--    use App\Models\Upazila;--}}
{{--    use App\Models\District;--}}
{{--    if (isset($_GET['branch_district'])){--}}
{{--        $district = District::find($_GET['branch_district']);--}}
{{--    }--}}
{{--    if (isset($_GET['branch_upazila'])){--}}
{{--        $upazila = Upazila::find($_GET['branch_upazila']);--}}
{{--    }--}}
{{--    @endphp--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Branch Application List</strong>
                        <a href="{{route('admin.branch.add')}}" class="float-right btn btn-primary">Add Branch</a></h3>
                    <hr>
{{--                    <form action="">--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch Division</label>--}}
{{--                                <select name="branch_division" id="division_id" class="form-control">--}}
{{--                                    <option value="">All</option>--}}
{{--                                    @foreach($divisions as $division)--}}
{{--                                        <option value="{{$division->id}}"--}}
{{--                                        @isset($_GET['branch_division']){{$_GET['branch_division'] == $division->id ? 'selected': ''}}@endisset>--}}
{{--                                            {{$division->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch District</label>--}}
{{--                                <select name="branch_district" id="district_id" class="form-control">--}}
{{--                                    <option value="">All</option>--}}
{{--                                        <option value="{{$_GET['branch_district']}}"--}}
{{--                                                @isset($_GET['branch_district']) selected @endisset--}}
{{--                                        >{{$district->name}}</option>--}}

{{--                                </select>--}}

{{--                            </div>--}}
{{--                            <div class="form-group col-sm-3"><label for="" class="form-control-label">Branch Upazila</label>--}}
{{--                                <select name="branch_upazila" id="upazila_id" class="form-control">--}}
{{--                                    <option value="">All</option>--}}
{{--                                    @isset($_GET['branch_upazila'])--}}
{{--                                        <option value="{{$_GET['branch_upazila']}}" selected>{{$upazila->name}}</option>--}}
{{--                                    @endisset--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <div class="form-group col-sm-3">--}}
{{--                                    <label for="filter" class="form-control-label text-white">-</label>--}}
{{--                                    <button type="submit" class="btn btn-primary" id="filter">Filter</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </form>--}}
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email<br><span class="second-line">Phone</span></th>
                            <th>Address</th>
                            <th>NID</th>
                            <th>Trade Licence</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)

                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name_en}}</span></td>
                                <td>{{$item->email}}<br><span>{{$item->phone}}</span></td>
                                <td>{{$item->address_en}}</td>
                                <td><img src="{{asset($item->nid_image)}}" alt="" height="150px" width="150px"></td>
                                <td><img src="{{asset($item->trade_licence_image)}}" alt=""  height="150px" width="150px"></td>
                                <td class="text-center">
                                    <div class="mt-2">
                                        <span class="{{$item->status == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->status == 1 ? 'Approved':'Pending'}}</span>
                                    </div>
                                </td>

                                <td class="btn-group">
                                    <a href="{{route('admin.branch.application.details', ['id'=>$item->id])}}" title="Details" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                    <form action="{{route('admin.branch.application.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" title="Remove" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        jQuery( document ).ready(function() {
            // alert('okay');
            jQuery('#division_id').change(function(){
                var division_id = jQuery(this).val();
                var url = '{{ route("admin.branch.get-district-by-division", ":division_id") }}';
                url = url.replace(':division_id',division_id);

                if(division_id!='0'){
                    jQuery.ajax({
                        url: url,
                        dataType: 'json',
                        beforeSend: function() {
                            //jQuery('select[name=\'division_id\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');
                        },
                        complete: function() {
                            jQuery('.wait').remove();
                        },
                        success: function(json) {
                            html = '<option value="">--Select--</option>';
                            for (i = 0; i < json.length; i++) {
                                html += '<option value="' + json[i]['id'] + '"';
                                html += '>' + json[i]['name'] + '</option>';
                            }

                            jQuery('select[name=\'branch_district\']').html(html);
                            html_upazila = '<option value="">--Select--</option>';
                            jQuery('select[name=\'branch_upazila\']').html(html_upazila);
                        }
                    });
                }else if(division_id=='0'){
                    html_upazila = '<option value="">--Select--</option>';
                    jQuery('select[name=\'branch_district\']').html(html_upazila);
                    jQuery('select[name=\'branch_upazila\']').html(html_upazila);
                }

            });

            jQuery('#district_id').change(function(){
                var district_id = jQuery(this).val();
                var url = '{{ route("admin.branch.get-upazila-by-district", ":district_id") }}';
                url = url.replace(':district_id',district_id);

                if(district_id>0){
                    jQuery.ajax({
                        url: url,
                        dataType: 'json',
                        beforeSend: function() {
                            // jQuery('select[name=\'branch_district\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');
                        },
                        complete: function() {
                            jQuery('.wait').remove();
                        },
                        success: function(json) {
                            html = '<option value="">--Select--</option>';
                            for (i = 0; i < json.length; i++) {
                                html += '<option value="' + json[i]['id'] + '"';
                                html += '>' + json[i]['name'] + '</option>';
                            }
                            jQuery('select[name=\'branch_upazila\']').html(html);
                        }
                    });
                }else{
                    html = '<option value="">--Select--</option>';
                    jQuery('select[name=\'branch_upazila\']').html(html);
                }
            });
        });
    </script>

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
    </script>

@endpush
