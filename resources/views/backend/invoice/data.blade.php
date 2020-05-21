<div class="box-body">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>SL NO</th>
            <th>Company Name</th>
            <th>Name</th>
            <th>Total </th>
            <th>Due</th>

            <th class="action-column">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($invoices as $key=>$invoice)

        <tr>
            <td>{{$invoice->invoice_id}}</td>
            <td>{{ !empty($invoice->company->name)?$invoice->company->name:'' }}</td>
            <td>{{ !empty($invoice->name)?$invoice->name:'' }}</td>
            <td>{{ $invoice->invoice_total }}</td>
            <td>{{ $invoice->amount_due }}</td>

            <?php $slug=explode('?',$invoice->invoice_id)[0]; ?>

            <td>
                <a href="{{route('edit-invoice',['invoice_id'=>$invoice->id])}}">Edit</a> 
                @if(Auth::user()->role=='admin')
                | <a href="javascript:void(0)" onclick="deleteConfirmation('{{route('delete-invoice',['invoice_id'=>$invoice->id])}}');" class="color-red">Delete</a> 
                @endif
                | <a href="{{route('invoice',['invoice_id'=>$invoice->id])}}" >View</a>
            </td>

        </tr>

        @endforeach

        </tfoot>
    </table>
    {{$invoices->appends(request()->query())->links()}}
</div>
