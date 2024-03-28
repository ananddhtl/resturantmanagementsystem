@extends('admin.layouts.main')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-md-4 ">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="me-auto">
                            <span class="fs-18">Categories</span>
                            <h2 class=" font-weight-bolder">1</h2>
                        </div>
                        <div
                            class="container border-0 p-3 m-0 bg-primary opacity-75 rounded-lg w-25 d-flex justify-content-center">
                            <i class="fas fa-bars fa-lg" style="font-size: 23px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 ">
                <div class="card ">
                    <div class="card-body  d-flex justify-content-around align-items-center">
                        <div class="me-auto">
                            <span class="fs-18">Product</span>
                            <h2 class=" font-weight-bolder">2</h2>
                        </div>
                        <div
                            class="container border-0 p-3 m-0 bg-success opacity-75 rounded-lg w-25 d-flex justify-content-center">
                            <i class="fa fa-bowl-food fa-lg" style="font-size: 25px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 ">
                <div class="card ">
                    <div class="card-body  d-flex justify-content-around align-items-center">
                        <div class="me-auto">
                            <span class="fs-18">Tables</span>
                            <h2 class=" font-weight-bolder">5</h2>
                        </div>
                        <div class="container border-0 p-3 m-0 bg-info rounded-lg w-25 d-flex justify-content-center">
                            <i class="fas fa-couch fa-lg" style="font-size: 25px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4 ">
                <div class="card">
                    <div class="card-body  d-flex justify-content-around align-items-center">
                        <div class="me-auto">
                            <span class="fs-18">Total Orders</span>
                            <h2 class=" font-weight-bolder">4</h2>
                        </div>
                        <div
                            class="container border-0 p-3 m-0 bg-secondary opacity-75 rounded-lg w-25 d-flex justify-content-center">
                            <i class="fas fa-shopping-bag fa-lg" style="font-size: 25px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-3 col-sm-6 col-md-4 ">
                <div class="card ">
                    <div class="card-body d-flex justify-content-around align-items-center">
                        <div class="me-auto">
                            <span class="fs-18">Today's Orders</span>
                            <h2 class=" font-weight-bolder">2</h2>
                        </div>
                        <div
                            class="container border-0 p-3 m-0 bg-danger opacity-75 rounded-lg w-25 d-flex justify-content-center">
                            <i class="fas fa-shopping-bag fa-lg" style="font-size: 25px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
