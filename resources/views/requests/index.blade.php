@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@section('title')
    جميع الطلبات
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                جميع الطلبات </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')


@if (session()->has('msg'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم ارسال الطلب بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم تحديث الطلب بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم رفض الطلب ",
                type: "error"
            });
        }
    </script>
@endif
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            @can('اضافة قسم')
                                <a class="btn btn-primary btn-sm" href="{{ route('requests.create') }}">اضافة</a>
                            @endcan
                        </div>
                    </div>
                    <br>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th> اسم الموظف </th>
                                <th> القسم القديم </th>
                                <th> القسم الحالي </th>
                                <th>  التاريخ </th>
                                <th>  قبول المدير الحالي  </th>
                                <th>  قبول المدير العام  </th>
                                <th>  قبول مدير النقل  </th>
                                <th>   الحالة   </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $key => $request)
                                <tr>
                                    <td>{{ $request->user->name }}</td>
                                    <td>{{ isset($request->transfer_deparment_id) ? $request->section->name : ''}}</td>
                                    <td>{{ $request->user->section->name }}</td>
                                    <td>{{ $request->date }}</td>
                                    <td>{{ ($request->current_manager_acceptance >0) ? 'تم قبول الطلب' : 'قيد الانتظار'}}</td>
                                    <td>{{  ($request->general_manager_acceptance  >0) ? 'تم قبول الطلب' : 'قيد الانتظار'}}</td>
                                    <td>{{  ($request->transfer_manager_acceptance  >0) ? 'تم قبول الطلب' : 'قيد الانتظار'}}</td>
                                    <td>{{  ($request->statas  ==0) ? 'قيد الانتظار' : 'تم قبول الطلب '}}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
