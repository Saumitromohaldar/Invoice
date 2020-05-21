<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th class="action-column">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($documents as $key=>$document)
        
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $document->title }}</td>
        <td>
            @if(Auth::user()->role=='admin')
                <a href="{{route('delete-document',['document_id'=>$document->id])}}" onclick="return confirm('Are you sure you want to delete this item?');" class="color-red">Delete</a>
            @endif
            | <a href="{{  }}route('download-document',['document_id'=>$document->id])}}">Download</a>
        </td>
    </tr>

    @endforeach

    </tfoot>
</table>

