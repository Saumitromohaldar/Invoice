@if(count($categories)>0)
<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>SL NO</th>
        <th>Name</th>
        <th>Type</th>        
        <th class="action-column">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($categories as $key=>$category)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $category->name }}</td>       
        <td>{{ $category->type }}</td>
        <td>
            <a href="{{route('categories.edit',$category->id)}}">Edit</a> 
            @if(Auth::user()->role=='admin')
            | <a href="javascript:void(0)"onclick="deleteCategory('{{route('categories.destroy',$category->id)}}');" class="color-red">Delete</a> 
            @endif
            
        </td>
    </tr>

    @endforeach

    </tfoot>
</table>
{{$categories->appends(request()->query())->links()}}

@else
    <div class="clear"></div> 
    <div class="text-center">
        <h2>There are no category available</h2>
        <a class="btn btn-primary btn-sm" href="{{route('categories.create')}}">Add Category</a>
    </div>
@endif
