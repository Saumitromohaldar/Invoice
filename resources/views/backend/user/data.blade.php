@if(count($users)>0)
<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>SL NO</th>
        <th>Name</th>        
        <th>Email</th>
        <th>Phone No</th>
        <th class="action-column">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($users as $key=>$user)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $user->name }}</td>        
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone_no }}</td>
        <td>
            <a href="{{route('users.edit',['user'=>$user->id])}}">Edit</a> 
            @if(Auth::user()->role=='admin')
            | <a href="javascript:void(0)"onclick="deleteConfirmation('{{route('users.destroy',$user->id)}}');" class="color-red">Delete</a>
            @endif
            {{-- | <a href="{{  route('users.show',['user'=>$user->id]) }}" >View</a> --}}
        </td>
    </tr>

    @endforeach

    </tfoot>
</table>
{{$users->appends(request()->query())->links()}}

@else
    <div class="clear"></div> 
    <div class="text-center">
        <h2>There are no user available</h2>
        <a class="btn btn-primary btn-sm" href="{{route('users.create')}}">Add User</a>
    </div>
@endif
