@extends('admin.master')
@section('title')
    Get Registration Card
@endsection
@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><strong>Student Registration Card</strong></h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="input-group">
                            <input type="number" id="" name="student_roll" placeholder="Enter Student Roll No" class="form-control">
                            <div class="input-group-btn"><button type="submit" class="btn btn-primary">Submit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 @isset($_GET['student_roll']) @if($_GET['student_roll']>0) d-block @else d-none @endif  @endisset">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><strong>Student Information</strong></h3></div>
                <div class="card-body">
                    @isset($item)
                    <table class="table">
                        <tr>
                            <th>Student Name</th>
                            <td>{{$item->student->student_name}}</td>
                        </tr>
                        <tr>
                            <th>Roll No</th>
                            <td>{{$item->student_roll}}</td>
                        </tr>
                        <tr>
                            <th>Registration No</th>
                            <td>{{$item->student_registration}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center"><a href="{{route('student.registration.print', ['id'=>$item->id])}}" class="btn btn-primary">Print Registration Card</a></td>
                        </tr>
                    </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
