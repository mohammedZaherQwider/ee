@extends('layouts.master')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .accept-button,
        .reject-button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .accept-button {
            background-color: #2ecc71;
            color: #fff;
        }

        .reject-button {
            background-color: #e74c3c;
            color: #fff;
        }

        .accept-button:hover,
        .reject-button:hover {
            opacity: 0.8;
        }
    </style>

@section('title')
    طلبات النقل
@stop
{{-- show section and all emp in this section --}}

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الطلبات </h4>

        </div>
    </div>
</div>
<!-- breadcrumb -->

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('homee') }}">رجوع</a>
                    </div>
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-4">
                        <ul id="treeview1">
                            @foreach ($requests as $request)
                                @if (Auth::user()->section->manager->sections_id == $request->current_department_id && $request->current_manager_acceptance==0 &&  $request->statas==0 )
                                    <div class="">
                                        <h4> الموظف : {{ $request->user->name }}
                                            <br> يريد النقل من القسم الحالي
                                            لقسم {{ $request->section->name }}
                                        </h4>
                                        <form action="{{ route('accept', $request) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="new">
                                            <button class="accept-button"> موافقة الطلب </button>
                                        </form>
                                        <br>
                                        <form action="{{ route('regect', $request) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="new">
                                            <button class="reject-button"> رفض الطلب </button>
                                        </form>
                                    </div>
                                @endif

                                @if (Auth::user()->section->manager->sections_id == $request->transfer_deparment_id && $request->transfer_manager_acceptance==0 &&  $request->statas==0)
                                    @if ($request->current_manager_acceptance > 0)
                                        <div class="">
                                            <h4> الموظف {{ $request->user->name }}
                                                <br> يريد النقل
                                                لقسم {{ $request->section->name }}
                                            </h4>
                                            <form action="{{ route('accept', $request) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="future">
                                                <button class="accept-button"> موافقة الطلب </button>

                                            </form>
                                            <br>
                                            <form action="{{ route('regect', $request) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="future">
                                                <button class="reject-button"> رفض الطلب </button>
                                            </form>
                                        </div>
                                    @endif
                                @endif

                                @if (Auth::user()->section->manager->is_super_manager == 1 && $request->general_manager_acceptance ==0 &&  $request->statas==0)
                                    @if ($request->transfer_manager_acceptance > 0 )
                                        <div class="">
                                            <h4> الموظف {{ $request->user->name }}
                                                <br> يريد النقل
                                                لقسم {{ $request->section->name }}
                                            </h4>
                                            <form action="{{ route('accept', $request->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="manager">
                                                <button class="accept-button"> موافقة الطلب </button>
                                            </form>
                                            <br>
                                            <form action="{{ route('regect', $request) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="manager">
                                                <button class="reject-button"> رفض الطلب </button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                        </ul>
                    </div>
                    <!-- /col -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>

@endsection
