@extends('admin.app')

@section('admin.content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الطاولات</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url('/dashboard/tables/add') }}"
                                class="btn btn-md round btn-outline-primary float-right">أضافة طاولة</a>
                            <h4 class="card-title">الطاولات</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                @include('admin.includes.errors')
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Table Number</th>
                                            <th>Table Status</th>
                                            <th>Edit</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tables as $key => $table)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>ِ{{ $table->table_number }}</td>
                                                <td>{{ $table->table_status ? "مشغولة" : "فارغة" }}</td>
                                                <td>
                                                    <a href="{{ url('/dashboard/tables/edit', $table->id) }}"
                                                        class="btn btn-sm round btn-outline-info">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/dashboard/tables/delete', $table->id) }}"
                                                        class="btn btn-sm round btn-outline-danger" onclick="return confirm('هل انت متاكد من حذف هذا العنصر')">Remove</a>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr >
                                                    <td class="text-center" colspan="5"><h1>لايوجد طاولات حتى الان</h1></td>
                                                </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
