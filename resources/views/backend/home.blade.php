@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('content')
<section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
</section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
     <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header">
              <h3 class="box-title">All Companies</h3>
            </div>

            @if(session()->has('message'))
                <div class="callout callout-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            @include('backend.company.data')


        </div>
     </div>


    </div>
    <!-- /.row -->

    <!-- /.row (main row) -->

  </section>
@endsection
