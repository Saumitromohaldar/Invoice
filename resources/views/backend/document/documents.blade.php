@extends('backend.layouts.app')
@section('title', 'Add Company')
@section('content')
    <section class="content-header">
        <h1>
            Official Documents
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Official Documents</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info ">
                <div class="box-header">
                    <h3 class="box-title">Documents</h3>
                    <div class="col-md-6 pull-right">
                        <form action="{{route('official-documents')}}" method="GET">
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

                    <table class="table">
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        
                    @if(count($folders))
                        @foreach ($folders as $folder)
                            <tr>
                                <td>
                                    <a href="{{route('official-documents',['folder_id'=>$folder->id])}}">
                                        <img class="folder-icon" src="{{asset('backend/images/folder-icon.png')}}" alt="">                                       
                                    </a>
                                </td>
                                <td>
                                    <div class="file-folder-name"><a href="{{route('official-documents',['folder_id'=>$folder->id])}}">{{$folder->folder_name}}</a></div>
                                </td>
                                <td>
                                    <a class="btn  btn-primary btn-sm" href="{{route('official-documents',['folder_id'=>$folder->id])}}">Open</a>
                                    <a onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm" href="{{route('delete-folder',['id'=>$folder->id])}}">Delete</a>
                                </td>
                            </tr>
                            {{-- <div class="folder-item">
                                <a href="{{route('official-documents',['folder_id'=>$folder->id])}}">
                                    <img class="folder-icon" src="{{asset('backend/images/folder-icon.png')}}" alt="">
                                    <div class="file-folder-name">{{$folder->folder_name}}</div>
                                </a>
                                <a onclick="return confirm('Are you sure you want to delete this item?');" class="color-red delete-doc" href="{{route('delete-folder',['id'=>$folder->id])}}"><i class="fa fa-trash"></i></a>
                            </div> --}}

                        @endforeach
                    @endif

                    @if(count($documents))
                        @foreach ($documents as $document)
                        @php                               
                            $info = pathinfo($document->file_name);
                            $ext = !empty($info['extension'])?$info['extension']:'doc-icon';
                            if(!in_array($ext,['docx','doc','pdf','png','ppt','pptx','xlsx','xls','jpg','jpeg'])){
                                $ext='doc-icon';
                            }
                        @endphp
                        <tr>
                            <td>
                                <a href="{{route('download-document',['document_id'=>$document->id])}}">
                                    <img class="folder-icon" src="{{asset('backend/images/'.$ext.'.png')}}" alt="">
                                    
                                </a>
                            </td>
                            <td>
                                <div class="file-folder-name"><a href="{{route('download-document',['document_id'=>$document->id])}}">{{trim(substr($document->file_name, strpos($document->file_name, '-') + 1))}}</a></div>
                            </td>
                            <td>
                                <a class="btn  btn-primary btn-sm" target="_blank" href="{{ asset('public/storage/'.$folder_id.'/'.$document->file_name) }}">View</a>
                                <a class="btn btn-primary btn-sm" target="_blank" href="{{route('download-document',['document_id'=>$document->id])}}">Download</a>
                                <a onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm" href="{{route('delete-file',['id'=>$document->id])}}">Delete</a>
                                

                            </td>
                        </tr>
                            {{-- <div class="folder-item">
                                <a href="{{route('download-document',['document_id'=>$document->id])}}">
                                    <img class="folder-icon" src="{{asset('backend/images/'.$ext.'.png')}}" alt="">
                                    <div class="file-folder-name">{{trim(substr($document->file_name, strpos($document->file_name, '-') + 1))}}</div>
                                </a>
                                <a onclick="return confirm('Are you sure you want to delete this item?');" class="color-red delete-doc" href="{{route('delete-file',['id'=>$document->id])}}"><i class="fa fa-trash"></i></a>
                                <a class="btn btn-block btn-primary btn-sm mt-10" target="_blank" href="{{ asset('public/storage/'.$folder_id.'/'.$document->file_name) }}">View</a>
                                <a class="btn btn-block btn-primary btn-sm" target="_blank" href="{{route('download-document',['document_id'=>$document->id])}}">Download</a>

                            </div> --}}

                        @endforeach
                    @endif
                        </table>
                    {{-- @include('backend.document.data') --}}
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>

                <div class="card-footer">
                    <div class="col-md-6">
                        <form action="{{route('create-folder',['folder_id'=>$folder_id])}}" method="POST" id="create-folder">
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
                        <form method="POST" id="save-document" action="{{route('save-document',['folder_id'=>$folder_id])}}" enctype="multipart/form-data">
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


    
    <!-- /.row (main row) -->
    </section>

@endsection
