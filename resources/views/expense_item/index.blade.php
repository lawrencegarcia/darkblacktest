@extends('layouts.app')

@section('header')
    <h2>Expense List</h2>
@stop


<?php

session_start();

if (isset($_GET['expense_id']))
{
    $expense_id = $_GET['expense_id'];
    echo '<script type="text/javascript">
            var storedExpenseID = "' .  $expense_id . '";
        </script>';
    
    
}
else
{
    echo 'Something messed up yo';
    //echo $expense_id = '<script>document.write(storedExpenseID);</script>';
}
?>


@section('content')

<script type="text/javascript">
            document.write(storedExpenseID)
            document.getElementById("expenseid").value = storedExpenseID;
</script>
    
    <a href="{{ url('/expense') }}" class="btn btn-primary">Back to Expenses</a>
    <table class="table table-bordered table-responsive" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>ID 
                    <?php
                    echo'<script> document.write(storedExpenseID); </script>';

                    ?>
                
                </th>
                <th>expense_id</th>
                <th>description</th>
                <th>category</th>
                <th>amount</th>
                <th>GST</th>
                <th>PST</th>
                <th>created at</th>
                <th>updated at</th>
                <th colspan="3"><form method="get" action="/expenseitem/create">
                    <input type="hidden" name="expenseid" value="<?php echo'<script> document.write(storedExpenseID); </script>';?>">
                    <input type="submit" value="Add Item">
                    </form></th>
                
                
            </tr>
        </thead>
        <tbody>
        @foreach($expense_items as $expense_item)
            <tr>
                <td>{{ $expense_item->id }}</td>
                <td>{{ $expense_item->expense_id }}</td>
                <td>{{ $expense_item->description }}</td>
                <td>{{ $expense_item->category }}</td>
                <td>{{ $expense_item->amount }}</td>
                <td>{{ $expense_item->gst }}</td>
                <td>{{ $expense_item->pst }}</td>
                <td>{{ $expense_item->created_at }}</td>
                <td>{{ $expense_item->updated_at }}</td>
                <td>
                    <a href="{{ route('expenseitem.edit', $expense_item->id) }}" class="btn btn-success">Edit</a></td>
                   <td> {!! Form::open(['method'=>'delete', 'route'=>['expenseitem.destroy', $expense_item->id]]) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger', 'onclick'=>'return confirm("Do you want to delete this record?")']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
      @endforeach
        </tbody>
@stop