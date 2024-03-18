@extends('admin.master')
@section('title')
    Approval For Branch
@endsection
@section('content')

    <div class="card">
        <div class="card-header"><h3>Application Form</h3></div>

        <div class="card-body">
            <!-- Register Start -->
            <div class="row mt-2">
                <div class="col-md-12">
                    <form action="{{route('admin.branch.add')}}" enctype="multipart/form-data" class="row g-3 mt-2">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <div class="col-md-6 mb-3">
                            <label for="studentNameEn" class="form-label fw-bold fw-bold">Name In English <span class="text-danger">*</span></label>
                            <input name="" type="text" class="form-control" id="studentNameEn" value="{{$item->name_en}}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="studentNameBn" class="form-label fw-bold fw-bold">Your Name In Bangla <span class="text-danger">*</span> </label>
                            <input name="" type="text" class="form-control" id="studentNameBn" value="{{$item->name_bn}}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fathername" class="form-label fw-bold">Father's Name <span class="text-danger">*</span></label>
                            <input name="" type="text" class="form-control" id="fathername" value="{{$item->father_name}}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nidnumber" class="form-label fw-bold">National ID Card Number <span class="text-danger">*</span></label>
                            <input name="" type="number" class="form-control" id="nidnumber" value="{{$item->nid_number}}" readonly>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="institutionNameEn" class="form-label fw-bold">Institution Name In English <span class="text-danger">*</span></label>
                            <input name="" type="text" class="form-control" id="institutionNameEn" value="{{$item->institution_name_en}}" readonly>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="institutionNameBn" class="form-label fw-bold">Institution Name In Bangla <span class="text-danger">*</span></label>
                            <input name="" type="text" class="form-control" id="institutionNameBn" value="{{$item->institution_name_bn}}" readonly>

                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputAddressEn" class="form-label fw-bold">Address Of Institution In English <span class="text-danger">*</span></label>
                            <input name="" type="text" class="form-control" id="inputAddressEn"value="{{$item->address_en}}" readonly>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputAddressBn" class="form-label fw-bold">Address Of Institution In Bangla <span class="text-danger">*</span></label>
                            <input name="" type="text" class="form-control" id="inputAddressBn" value="{{$item->address_bn}}" readonly>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="number" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input name="" type="number" class="form-control" id="number" value="{{$item->phone}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input name="" type="email" class="form-control" id="inputEmail4"value="{{$item->email}}" readonly>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formFile" class="form-label fw-bold">Passport Size Picture - JPG <span class="text-danger">*</span></label><br>
                            <img src="{{asset($item->head_image)}}" height="150px" width="150px" alt="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formFile2" class="form-label fw-bold">National ID Card Scan Copy <span class="text-danger">*</span></label><br>
                            <img src="{{asset($item->nid_image)}}" height="150px" width="150px" alt="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formFile3" class="form-label fw-bold">Trade Licence Scan Copy <span class="text-danger">*</span></label><br>
                            <img src="{{asset($item->trade_licence_image)}}" height="150px" width="150px" alt="">
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary px-5 py-2">Approve for Branch</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Register End -->
        </div>
    </div>

@endsection
