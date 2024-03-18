@extends('frontend.master')
@section('title')
    Apply For Branch
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Apply For Branch</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item text-light">/</li>
                            <li class="breadcrumb-item text-light active" aria-current="page">Branch Registration</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Register Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row d-flex flex-lg-row g-4">
                <div class="col-md-12 text-center">
                    <h3 class="text-success">{{session('message')}}</h3>
                </div>
            </div>
            <div class="row d-flex flex-column-reverse flex-lg-row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h3>Get In Touch</h3>
                    <p class="contact-text mb-4 mt-4">The contact form is currently inactive. Get a functional and working contact form
                        with Ajax & PHP in a few minutes. Just copy and paste the files, add a little text and you're
                        done.
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">মনসুর ম্যানশন, পুরাতন কৃষি ব্যাংক এর ৩য় তলা, কেশব মোড়, মাগুরা সদর ,মাগুরা।</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">+8801308-860635</p>
                            <p class="mb-0">+8801933-840820</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">info@bdyouthict.com</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                    <h3>Application Form</h3>
                    <form action="{{route('branch.apply.submit')}}" method="post" enctype="multipart/form-data" class="row g-3 mt-2">
                        @csrf
                        <div class="col-md-6">
                            <label for="studentNameEn" class="form-label fw-bold fw-bold">Your Name In English <span class="text-danger">*</span></label>
                            <input name="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" id="studentNameEn" placeholder="Enter Your Name In English" required>
                            @error('name_en')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="studentNameBn" class="form-label fw-bold fw-bold">Your Name In Bangla <span class="text-danger">*</span> </label>
                            <input name="name_bn" type="text" class="form-control @error('name_bn') is-invalid @enderror" id="studentNameBn" placeholder="Enter Your Name In Bangla" required>
                            @error('name_bn')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="fathername" class="form-label fw-bold">Father's Name <span class="text-danger">*</span></label>
                            <input name="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror" id="fathername" placeholder="Enter Your Father's Name" required>
                            @error('father_name')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nidnumber" class="form-label fw-bold">National ID Card Number <span class="text-danger">*</span></label>
                            <input name="nid_number" type="number" class="form-control @error('nid_number') is-invalid @enderror" id="nidnumber" placeholder="Enter Your National ID Card Number" required>
                            @error('nid_number')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="institutionNameEn" class="form-label fw-bold">Institution Name In English <span class="text-danger">*</span></label>
                            <input name="institution_name_en" type="text" class="form-control @error('institution_name_en') is-invalid @enderror" id="institutionNameEn" placeholder="Enter Your Institution Name In English" required>
                            @error('institution_name_en')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="institutionNameBn" class="form-label fw-bold">Institution Name In Bangla <span class="text-danger">*</span></label>
                            <input name="institution_name_bn" type="text" class="form-control @error('institution_name_bn') is-invalid @enderror" id="institutionNameBn" placeholder="Enter Your Institution Name In Bangla" required>
                            @error('institution_name_bn')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputAddressEn" class="form-label fw-bold">Address Of Institution In English <span class="text-danger">*</span></label>
                            <input name="address_en" type="text" class="form-control @error('address_en') is-invalid @enderror" id="inputAddressEn" placeholder="Enter Address Of Institution In English" required>
                            @error('address_en')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputAddressBn" class="form-label fw-bold">Address Of Institution In Bangla <span class="text-danger">*</span></label>
                            <input name="address_bn" type="text" class="form-control @error('address_bn') is-invalid @enderror" id="inputAddressBn" placeholder="Enter Address Of Institution In Bangla" required>
                            @error('address_bn')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="number" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" id="number" placeholder="Enter Your Number" required>
                            @error('phone')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail4" placeholder="Enter Your Email" required>
                            @error('email')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="formFile" class="form-label fw-bold">Passport Size Picture - JPG <span class="text-danger">*</span></label>
                            <input class="form-control @error('head_image') is-invalid @enderror" name="head_image" type="file" id="formFile" placeholder="Upload Branch Head Image" required>
                            @error('head_image')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="formFile2" class="form-label fw-bold">National ID Card Scan Copy <span class="text-danger">*</span></label>
                            <input class="form-control @error('nid_image') is-invalid @enderror" name="nid_image" type="file" id="formFile2" placeholder="Upload Image" required>
                            @error('nid_image')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="formFile3" class="form-label fw-bold">Trade Licence Scan Copy <span class="text-danger">*</span></label>
                            <input class="form-control @error('trade_licence_image') is-invalid @enderror" name="trade_licence_image" type="file" id="formFile3" placeholder="Upload Image" required>
                            @error('trade_licence_image')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" name="status" type="checkbox" id="gridCheck" required>
                                <label class="form-check-label" for="gridCheck">
                                    By clicking submit, I agree that my all information is true.
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
@endsection
