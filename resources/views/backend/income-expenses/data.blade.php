@if(count($income_expenses)>0)
<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>SL NO</th>
        <th>Date</th>
        <th>Description</th> 
        <th>Note</th>       
        <th>Income</th>
        <th>Expense</th>
        <th class="action-column">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($income_expenses as $key=>$income_expense)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{date('d/m/Y',strtotime($income_expense->date))}}</td>
        <td>{{ !empty($income_expense->category->name)?$income_expense->category->name:'' }}</td>       
        <td>{{$income_expense->note}}</td>
        <td>@if($income_expense->type=="Income"){{ $income_expense->amount }} @endif</td>
        <td>@if($income_expense->type=="Expense"){{ $income_expense->amount }}@endif</td>        
        <td>
            <a href="{{route('income_expenses.edit',$income_expense->id)}}">Edit</a> 
            @if(Auth::user()->role=='admin')
            | <a href="javascript:void(0)"onclick="deleteCategory('{{route('income_expenses.destroy',$income_expense->id)}}');" class="color-red">Delete</a> 
            @endif
            
        </td>
    </tr>
    

    @endforeach
    <tr class="font-weight-bold">
        @php
            $credit=$income_expenses->where('type','Income')->sum('amount');
            $debit=$income_expenses->where('type','Expense')->sum('amount');
            
        @endphp
        <td colspan="4" class="text-right">Total</td>
        <td>{{$credit}}</td>
        <td>{{$debit}}</td>
        <td></td>
    </tr>

    <tr class="font-weight-bold">
        @php
           // $credit=$income_expenses->where('type','Income')->sum('amount');
            //$debit=$income_expenses->where('type','Expense')->sum('amount');
            $blance=$credit-$debit;
        @endphp
        <td colspan="5" class="text-right">Blance</td>
        <td>{{$blance}}</td>
        <td></td>
    </tr>
    </tfoot>
</table>

@else
    <div class="clear"></div> 
    <div class="text-center">
        <h2>There are no income/expense available</h2>
        <a class="btn btn-primary btn-sm" href="{{route('income_expenses.create')}}">Add Income/Expense</a>
    </div>
@endif
