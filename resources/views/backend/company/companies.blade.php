@extends('backend.layouts.app')
@section('title', 'Companies')
@section('content')
<section class="content-header">
        <h1>
            Companies
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Companies</li>
        </ol>
    </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         <div class="col-md-12">
            <div class="box box-info">

                <div class="box-header">
                    <h3 class="box-title">All Companies</h3>

                    <div class="pull-right">
                        <a class="btn btn-block btn-primary btn-sm" href="{{ route('create-company') }}">Add Company</a>
                    </div>


                </div>

                @if(session()->has('message'))
                    <div class="callout callout-info">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="box-body">
                    <div class="col-md-4 ">
                        <form action="{{route('companies')}}" method="GET">
                            <div class="input-group input-group-sm form-group">
                                <input type="text" class="form-control" name="query" value="{{!empty($_GET['query'])?$_GET['query']:''}}">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </span>
                            </div>
                        </form>
                    </div>

                    @include('backend.company.data')

                    <div class="clear"></div>
                </div>

                <div class="clear"></div>
            </div>
         </div>


        </div>
        <!-- /.row -->

        <!-- /.row (main row) -->

      </section>
@endsection
