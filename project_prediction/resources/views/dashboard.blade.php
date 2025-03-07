@extends('layouts.app')

@section('content')
<div class="col-lg-7 col-md-12">
    <!-- support-section start -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <h2 class="m-0">350</h2>
                    <span class="text-c-blue">Support Requests</span>
                    <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                </div>
                <div id="support-chart"></div>
                <div class="card-footer bg-primary text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white">10</h4>
                            <span>Open</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">5</h4>
                            <span>Running</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">3</h4>
                            <span>Solved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <h2 class="m-0">350</h2>
                    <span class="text-c-green">Support Requests</span>
                    <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                </div>
                <div id="support-chart1"></div>
                <div class="card-footer bg-success text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white">10</h4>
                            <span>Open</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">5</h4>
                            <span>Running</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">3</h4>
                            <span>Solved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- support-section end -->
</div>
<div class="col-lg-5 col-md-12">
    <!-- page statustic card start -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-yellow">$30200</h4>
                            <h6 class="text-muted m-b-0">All Earnings</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-bar-chart-2 f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-yellow">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">% change</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-green">290+</h4>
                            <h6 class="text-muted m-b-0">Page Views</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-file-text f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-green">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">% change</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page statustic card end -->
</div>
@endsection