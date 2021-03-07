@extends('admin.app')
@section('admin.content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">لوحة التحكم</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><a href="{{ url('/dashboard/staff') }}"><i class="fas fa-id-card-alt fa-2x card-icon" title=""></i></a></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Staff</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-sitemap fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Categories</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-clipboard-list fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Menu</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-file-alt fa-2x card-icon2" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Orders</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-box-open fa-2x card-icon2" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Products</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><a href="{{ url('dashboard/tables') }}"><i class="fas fa-microchip fa-2x card-icon2" title=""></i></a></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Tables</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-utensils fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Kitchen</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-dolly fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Suppliers</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-tags fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Discounts</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-chart-bar fa-2x card-icon2" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Analytics</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-file-invoice fa-2x card-icon2" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Reports</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-cash-register fa-2x card-icon2" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Counters</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-shopping-basket fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Purchases</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-file-invoice-dollar fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Invoices</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content text-center">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1><i class="fas fa-percent fa-2x card-icon" title=""></i></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-muted">Taxes</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
                
                           
            </div>
        </div>
    </div>
@endsection
