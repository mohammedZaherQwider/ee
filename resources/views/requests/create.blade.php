@extends('layouts.master')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@section('title')
    اضافة طلب
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">اضافة طلب </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach (is_array($errors) ? $errors : $errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




{!! Form::open(['route' => 'requests.store', 'method' => 'POST']) !!}
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="row">
                        <div class="col-xs-7 col-sm-7 col-md-7">
                            <div class="form-group">
                                <p> اسم الموظف :</p>
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'displayed' => 'displayed']) !!}
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p> السحل المدني :</p>
                            {!! Form::text('civil_registry', Auth::user()->civil_registry, [
                                'class' => 'form-control',
                                'displayed' => 'displayed',
                            ]) !!}
                        </div>

                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p> اسم المدير المباشر :</p>
                            {!! Form::text('manager_name', Auth::user()->section->manager->name, [
                                'class' => 'form-control',
                                'displayed' => 'displayed',
                            ]) !!}
                        </div>

                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p> السجل المدني للرئيس المباشر :</p>
                            {!! Form::text('employee_civil_registry', Auth::user()->section->manager->empManager->employee_civil_registry, [
                                'class' => 'form-control',
                                'displayed' => 'displayed',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p> الادارة الحالية :</p>
                            {!! Form::text('section_name', Auth::user()->section->name, [
                                'class' => 'form-control',
                                'displayed' => 'displayed',
                            ]) !!}
                            {!! Form::text('section_id', Auth::user()->section->sections_id, ['class' => 'form-control', 'style' => 'display:none;']) !!}

                        </div>

                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p> الادارة المراد النقل اليها :</p>
                            <select name="section_id_new" id="select-section"
                                class="form-control  nice-select  custom-select">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p> التاريخ :</p>
                            {!! Form::text('date', today()->toDateString(), ['class' => 'form-control']) !!}
                        </div>
                        <script>
                            console.log('div7');
                        </script>
                    </div>
                </div>
                <div class="row">
                    <!-- col -->
                    <!-- /col -->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-main-primary">تاكيد</button>
                    </div>

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

{!! Form::close() !!}
@endsection
@section('js')
<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>

<script>
    function getEmployeeName(type) {
        $.ajax({
                method: "POST",
                url: "{{ route('getEmployeeByCivilRegistry') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    civil_registry: (type == 'employee') ? $('input[name=employee_civil_registry]').val() : $(
                        'input[name=manager_civil_registry]').val(),
                    type: type
                }
            })
            .done(function(response) {
                console.log(response)
                if (response.status == true) {
                    if (type == 'employee') {
                        $('#employee_name').html(response.user.name);
                    } else {
                        $('#manager_name').html(response.user.name);
                    }
                }
            });
    }
</script>

@endsection
