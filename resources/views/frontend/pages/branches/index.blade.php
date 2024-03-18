@extends('frontend.master')
@section('title')
    Our Branches
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Our Branches</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item">/</li>
                            <li class="breadcrumb-item text-primary active" aria-current="page">All Branches</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <section class="">
       <div class="container mb-0">
           <div class="row">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header"><h3>Search Branch</h3></div>
                       <div class="card-body">
                           <form>
                               <div class="input-group">
                                   <input type="number" id="" name="branch_code" placeholder="Enter Branch Code" class="form-control" required>
                                   <div class="input-group-btn"><button type="submit" class="btn btn-primary">Submit</button></div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
            @isset($_GET['branch_code'])
           <div class="row mt-5">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3>Branch Details</h3>
                       </div>
                       <div class="card-body">
                           @isset($item)
                           <table class="table table-bordered">
                               <tr>
                                   <th><strong>Branch Name</strong></th>
                                   <td>{{$item->branch_name}}</td>
                                   <td rowspan="4" align="center" width="200px">
                                       <strong>Branch Head</strong><br>
                                       @if($item->head_image)
                                           <img src="{{asset($item->head_image)}}" alt="" height="200px" width="200px">
                                           @else
                                           <img src="{{asset('admin-assets')}}/images/default.jpg" alt="" height="200px" width="200px">
                                       @endif

                                   </td>
                               </tr>
                               <tr>
                                   <th><strong>Branch Code</strong></th>
                                   <td>{{$item->branch_code}}</td>
                               </tr>
{{--                               <tr>--}}
{{--                                   <th><strong>Contact No</strong></th>--}}
{{--                                   <td>{{$item->branch_phone}}</td>--}}
{{--                               </tr>--}}
{{--                               <tr>--}}
{{--                                   <th><strong>Email Address</strong></th>--}}
{{--                                   <td>{{$item->branch_email}}</td>--}}
{{--                               </tr>--}}
                               <tr>
                                   <th><strong>Address</strong></th>
                                   <td colspan=" ">{{$item->branch_address}}</td>
                               </tr>
                               <tr>
                                   <th><strong>Branch Status</strong></th>
                                   <td colspan=" ">{{$item->branch_status_id == 1 ? 'Active':'Inactive'}}</td>
                               </tr>
                           </table>
                           @else
                               <p>No Information Found</p>
                           @endisset
                       </div>
                   </div>
               </div>
           </div>
           @endisset
       </div>
    </section>
    <!--Page Header End-->
    <section class="product">
        <!-- profile Start -->
        <div class="accordion" id="accordionExample">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="row">
                            <div>
                                <div class="product__sidebar">
                                    <div class="shop-category product__sidebar-single">
                                        <h3>Divisions</h3>
                                        <ul class="list-unstyled">

                                            <li id="headingOne"><a class="" type="button"
                                                                   data-bs-toggle="collapse" data-bs-target="#barisalDivision"
                                                                   aria-expanded="true" aria-controls="barisalDivision">Barisal Division</a></li>
                                            <li id="headingTwo"><a class="collapsed" type="button"
                                                                   data-bs-toggle="collapse" data-bs-target="#chittagongDivision"
                                                                   aria-expanded="false" aria-controls="chittagongDivision">Chittagong Division</a></li>
                                            <li id="headingThree"><a class="collapsed" type="button"
                                                                     data-bs-toggle="collapse" data-bs-target="#dhakaDivision"
                                                                     aria-expanded="false" aria-controls="dhakaDivision">Dhaka Division</a></li>
                                            <li id="headingFour"><a class="collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#khulnaDivision"
                                                                    aria-expanded="false" aria-controls="khulnaDivision">Khulna Division</a></li>
                                            <li id="headingFive"><a class="collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#mymensinghDivision"
                                                                    aria-expanded="false" aria-controls="mymensinghDivision">Mymensingh Division</a></li>
                                            <li id="headingSix"><a class="collapsed" type="button"
                                                                   data-bs-toggle="collapse" data-bs-target="#rajshahiDivision"
                                                                   aria-expanded="false" aria-controls="rajshahiDivision">Rajshahi Division</a></li>
                                            <li id="headingSeven"><a class="collapsed" type="button"
                                                                     data-bs-toggle="collapse" data-bs-target="#rangpurDivision"
                                                                     aria-expanded="false" aria-controls="rangpurDivision">Rangpur Division</a></li>
                                            <li id="headingEight"><a class="collapsed" type="button"
                                                                     data-bs-toggle="collapse" data-bs-target="#sylhetDivision"
                                                                     aria-expanded="false" aria-controls="sylhetDivision">Sylhet Division</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">
                        <div class="row branch_table">
                            <!-- Barisal Division Branches History Start -->
                            <div id="barisalDivision" class="accordion-collapse collapse show"
                                 aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Barisal Division Branches History</h2>
                                    <div class="bd-example">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Barisal Division Branches History End -->

                            <!-- Chittagong Division Branches History Start -->
                            <div id="chittagongDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Chittagong Division Branches History</h2>
                                    <div class="bd-example">
                                        <table  class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Chittagong Division Branches History End -->

                            <!-- Dhaka Division Branches History Start -->
                            <div id="dhakaDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Dhaka Division Branches History</h2>
                                    <div class="bd-example">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Dhaka Division Branches History End -->

                            <!-- Khulna Division Branches History Start -->
                            <div id="khulnaDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingFour" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Khulna Division Branches History</h2>
                                    <div class="bd-example">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Khulna Division Branches History End -->

                            <!-- Mymensingh Division Branches History Start -->
                            <div id="mymensinghDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingFive" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Mymensingh Division Branches History</h2>
                                    <div class="bd-example">
                                        <table  class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Mymensingh Division Branches History End -->

                            <!-- Rajshahi Division Branches History Start -->
                            <div id="rajshahiDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingSix" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Rajshahi Division Branches History</h2>
                                    <div class="bd-example">
                                        <table  class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Rajshahi Division Branches History End -->

                            <!-- Rangpur Division Branches History Start -->
                            <div id="rangpurDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingSeven" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Rangpur Division Branches History</h2>
                                    <div class="bd-example">
                                        <table  class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Rangpur Division Branches History End -->

                            <!-- Sylhet Division Branches History Start -->
                            <div id="sylhetDivision" class="accordion-collapse collapse"
                                 aria-labelledby="headingEight" data-bs-parent="#accordionExample" style="padding: 27px 15px 13px;">
                                <div>
                                    <h2>Sylhet Division Branches History</h2>
                                    <div class="bd-example">
                                        <table  class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                                <th scope="col">Districts</th>
                                                <th scope="col">Branches</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">Dhaka</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Manikganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Gazipur</th>
                                                <th scope="col">2</th>
                                                <th scope="col">Narayonganj</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Munsiganj</th>
                                                <th scope="col">1</th>
                                                <th scope="col">Tangail</th>
                                                <th scope="col">1</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Sylhet Division Branches History End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- profile End -->
    </section>
    <!--Page Header End-->
@endsection
