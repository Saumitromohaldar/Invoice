@if(count($companies)>0)
<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>SL NO</th>
        <th>Company Name</th>
        <th>File Number</th>
        <th>Address</th>
        <th>Email</th>
        <th>Phone No</th>
        <th class="action-column">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($companies as $key=>$company)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $company->name }}</td>
        <td>{{ $company->file_number }}</td>
        <td>{{ $company->address }}{{ !empty($company->district)?', '.$company->district:'' }}{{ !empty($company->city)?', '.$company->city:'' }}</td>
        <td>{{ $company->email }}</td>
        <td>{{ $company->phone_no }}</td>
        <?php $slug=explode('?',$company->name)[0]; ?>
        <td>
            <a href="{{route('edit-company',['company_id'=>$company->id])}}">Edit</a> 
            @if(Auth::user()->role=='admin')
            | <a href="javascript:void(0)"onclick="deleteConfirmation('{{route('delete-company',['company_id'=>$company->id])}}');" class="color-red">Delete</a> 
            @endif
            | <a href="{{route('company',['company_id'=>$company->id])}}" >View</a>
        </td>
    </tr>

    @endforeach

    </tfoot>
</table>
{{$companies->appends(request()->query())->links()}}

@else
    <div class="clear"></div> 
    <div class="text-center">
        <h2>There are no company available</h2>
        <a class="btn btn-primary btn-sm" href="{{route('create-company')}}">Add Company</a>
    </div>
@endif
