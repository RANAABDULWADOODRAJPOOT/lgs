@extends('layouts.app')

@section('content')

<div class="main">
  
<h1 class="text-center m-5"> DHA Phase 5</h1>    <!-- Actual search box -->
    <form action="/search" method="post">
        @csrf
    <div class="form-group has-search">
      <span class="fa fa-search form-control-feedback"></span>
      <input type="text" class="form-control" placeholder="Search" name="id" value="<?php echo $search ?>">
      &nbsp;<span class="text-danger p-1"><b> <?php 
        echo $status;
        ?><b></span>
    </div>
</form>

    @if($status =='Found Record')

    <table class="table">
    
        <tbody>
            <tr>
                <td scope="row"></td>
                <td>Bill Number</td>
                <td>  <?php echo  $bill_number; ?></td>
            </tr>
            <tr>
                <td scope="row"></td>
                <td>Branch Name</td>
                <td><?php echo  $branch_name; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Bill Date</td>
                <td><?php echo  $bill_date; ?></td>
            </tr>
            <tr >
                <td scope="row"></td>
                <td>Due Date</td>
                <td class="text-danger"><?php echo  $due_date; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>First Name</td>
                <td><?php echo  $first_name; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Last Name</td>
                <td><?php echo  $last_name; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Address</td>
                <td><?php echo  $address; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Registration Number</td>
                <td><?php echo  $reg_no; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Phone</td>
                <td><?php echo  $phone; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Class</td>
                <td><?php echo  $class; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Fee For</td>
                <td><?php echo  $feefor; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Bill Month</td>
                <td><?php echo  $bill_month; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Fee Status</td>
                <td class="text-danger"><?php echo  $fee_status; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Total</td>
                <td><?php echo  $total; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Late Fine</td>
                <td class="text-danger"><?php echo  $fine; ?></td>
            </tr>

            <tr>
                <td scope="row"></td>
                <td>Grand Total</td>
                <td><?php echo  $grand_total; ?></td>
            </tr>
        </tbody>
    </table>

    @if($fee_status !='Paid')
    <form action="/submitfee" method="POST">
        @csrf
        <input type="hidden" name="id" value="<?php echo $bill_number ?>">
        <input type="hidden" name="fine" value="<?php echo $fine ?>">
        <input type="hidden" name="total" value="<?php echo $grand_total ?>">
        <button type="submit" class="btn btn-block btn-primary">Submitted</button>
        </form>
    @endif

    @endif

   
    

    
  </div>


  @endsection