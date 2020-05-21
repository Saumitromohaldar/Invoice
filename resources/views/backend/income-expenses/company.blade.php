@extends('backend.layouts.app')
@section('title', 'Company')
@section('content')
    <section class="content-header">
        <h1>
            Company
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Company</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-4">
            <div class="box box-info pb-5">
                
                <div class="box-header">
                    <h3 class="box-title">Company Info</h3>
                    <div class="pull-right">
                        <a class="btn btn-block btn-primary btn-sm" href="{{ route('create-invoice',['company_id'=>$company->id]) }}">Create Invoice</a>
                    </div>
                </div>


                    <!-- info row -->
                    <div class="box-body company-address">
                        <address>
                            <div class="clear">
                                <label for="">Company Name:</label> <strong> {{$company->name}}</strong>
                            </div>

                            @if(!empty($company->address))
                            <div class="clear">
                                <label for="">Address:</label> <span>{{$company->address}}</span>
                            </div>
                            @endif
                            @if(!empty($company->country))
                            <div class="clear">
                                <label for="">Country:</label> {{$company->country}}
                            </div>
                            @endif
                            @if(!empty($company->district))
                            <div class="clear">
                                <label for="">District:</label> {{$company->district}}
                            </div>
                            @endif
                            @if(!empty($company->city))
                            <div class="clear">
                                <label for="">City:</label> {{$company->city}}
                            </div>
                            @endif
                            @if(!empty($company->postcode))
                            <div class="clear">
                                <label for="">Postcode:</label> {{$company->postcode}}
                            </div>
                            @endif
                            @if(!empty($company->phone_no))
                            <div class="clear">
                                <label for="">Phone:</label> {{$company->phone_no}}
                            </div>
                            @endif
                            @if(!empty($company->email))
                            <div class="clear">
                                <label for="">Email:</label> {{$company->email}}
                            </div>
                            @endif

                            <hr>

                            <label>Registration Information</label>
                            @if(!empty($company->reg_no_online))
                            <div class="clear">
                                <label for="">Online Reg No:</label> {{$company->reg_no_online}}
                            </div>
                            @endif

                            @if(!empty($company->reg_no_manual))
                            <div class="clear">
                                <label for="">Manual Reg No:</label> {{$company->reg_no_manual}}
                            </div>
                            @endif

                            @if(!empty($company->reg_date))
                            <div class="clear">
                                <label for="">Reg Date:</label> {{$company->reg_date}}
                            </div>
                            @endif

                            @if(!empty($company->reg_user_name))
                            <div class="clear">
                                <label for="">User Name:</label> {{$company->reg_user_name}}
                            </div>
                            @endif

                            @if(!empty($company->reg_password))
                            <div class="clear">
                                <label for="">Password:</label> {{$company->reg_password}}
                            </div>
                            @endif

                            @if(!empty($company->reg_email))
                            <div class="clear">
                                <label for="">Email:</label> {{$company->reg_email}}
                            </div>
                            @endif
                            

                        </address>


                    </div>
                    <!-- /.row -->

                <div class="clear"></div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">All Invoices</h3>
                    <div class="pull-right">
                        <a class="btn btn-block btn-primary btn-sm" href="{{ route('create-invoice',['company_id'=>$company->id]) }}">Create Invoice</a>
                    </div>
                </div>
                @if(count($invoices))
                    @include('backend.invoice.data')
                @else
                <div class="box-body">
                    <h2 class="text-center">No invoice available</h2>

                </div>

                @endif
            </div>
        </div>



    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->


     <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info ">

                <div class="box-header">
                    <h3 class="box-title">Documents</h3>
                    <div class="col-md-6 pull-right">
                        <form action="{{route('company',['company_id'=>$company->id])}}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="query" value="{{!empty($_GET['query'])?$_GET['query']:''}}">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box-body">

                    
                    @if(count($folders))
                        @foreach ($folders as $folder)

                            <div class="folder-item">
                                <a href="{{route('company',['company_id'=>$company->id,'folder_id'=>$folder->id])}}">
                                    <img class="folder-icon" src="{{asset('backend/images/folder-icon.png')}}" alt="">
                                    <div class="file-folder-name">{{$folder->folder_name}}</div>
                                </a>
                                @if(Auth::user()->role=='admin')
                                <a href="javascript:void(0)"onclick="deleteConfirmation('{{route('delete-folder',['id'=>$folder->id])}}');"  class="color-red" ><i class="fa fa-trash"></i></a>
                                @endif
                            </div>

                        @endforeach
                    @endif

                    @if(count($documents))
                        @foreach ($documents as $document)

                            <div class="folder-item">
                                <a href="{{route('download-document',['document_id'=>$document->id])}}">
                                    <img class="folder-icon" src="{{asset('backend/images/doc-icon.png')}}" alt="">
                                    <div class="file-folder-name">{{trim(substr($document->file_name, strpos($document->file_name, '-') + 1))}}</div>
                                </a>
                                @if(Auth::user()->role=='admin')
                                <a href="javascript:void(0)"onclick="deleteConfirmation('{{route('delete-file',['id'=>$document->id])}}');" class="color-red"><i class="fa fa-trash"></i></a>
                                @endif
                            </div>

                        @endforeach
                    @endif

                    {{-- @include('backend.document.data') --}}
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>

                <div class="card-footer">
                    <div class="col-md-6">
                        <form action="{{route('create-folder',['folder_id'=>$folder_id,'company_id'=>$company->id])}}" method="POST" id="create-folder">
                            @csrf
                            <div class="input-group input-group-sm form-group">
                                <input type="text" name="folder_name" class="form-control">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary" value="Create Folder">
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <form method="POST" id="save-document" action="{{route('save-document',['folder_id'=>$folder_id,'company_id'=>$company->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group input-group-sm form-group">
                                    <input type="file" class="form-control" name="file" placeholder="File" value="{{ old('file') }}">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary" value="Upload File">
                                </span>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->


    </section>

@endsection
