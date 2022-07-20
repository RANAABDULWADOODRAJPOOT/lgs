<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DateTime;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\feeBills;
use App\Models\acdStudents;
use App\Models\acdApplicants;
use App\Models\acdClasses;
use App\Models\acdBatches;
use App\Models\regBranches;
use App\Models\acdStdGrdnDetail;
use App\Models\acdStudentsGuardians;
use App\Models\feeCollections;

class UserController extends Controller
{
    public function index(Request $request){
        $rec=" ";
        if($request->id==null || $request->id==''){
            $status="Not Found on Null";
            return view("home", ["status"=>$status, "search"=>$rec]);
        }else{

      
    
        $rec=$request->id;
        $bill=feeBills::where('receipt_no', $rec)->first();

        if(!is_null($bill)){

        $student_id=$bill['student_id'];
        $reg_id=$bill['reg_id'];
        $branch_id=$bill['branchid'];
        $class_id=$bill['branchid'];
        $class_name='';
        $info=null;
        if($student_id==0 || $student_id==null){
            $info=acdApplicants::where('id',  $reg_id)->first();
            $batch_id=$info['batchid'];
            $batches=acdBatches::where('batchid',  $batch_id)->first();
            $class_id= $batches['classes_id'];
            $classes=acdClasses::where('id',  $class_id)->first();
            $class_name= $classes['name'];
            $collection=$bill['collection_id'];
            $for=feeCollections::where('id',  $collection)->first();

        }else{
        $info=acdStudents::where('studentid',  $student_id)->first();
        $batch_id=$info['batchid'];
        $batches=acdBatches::where('batchid',  $batch_id)->first();
        $class_id= $batches['classes_id'];
        $classes=acdClasses::where('id',  $class_id)->first();
        $class_name= $classes['name'];
        $collection=$bill['collection_id'];
        $for=feeCollections::where('id',  $collection)->first();
    
        }


         $guardian_student=acdStudentsGuardians::where('studentid',  $student_id)->first();
         $guardian_id=$guardian_student['guardianid'];
         $guardian=acdStdGrdnDetail::where('id',  $guardian_id)->first();
         $branch=regBranches::where('iid',  $branch_id)->first();
        


         $branch_name=$branch['name'];
         $bill_number=$bill['receipt_no'];
         $bill_date=$bill['received_date'];
         $due_date=$bill['duedate'];
         $firstname=$info['firstname'];
         $lastname=$info['lastname'];
         $address=$info['address'];
         $reg_no=$info['registrationno'];
         $phone=$guardian['cellphone'];
         $class=$class_name;
         $feeFor=$for['name'];
         $bill_month=$bill['print_date'];
         $total=$bill['bill_amount'];
         $feestatus=$bill['status'];
         $current_date=time();
         $late=$current_date-strtotime($due_date);
         $late_days=round($late / (60 * 60 * 24));
         $fine=0;
         if($late_days>0){
             $fine=$late_days*500;
         }
         $grand_total=$total+$fine;

         $status="Found Record";
         if($feestatus!=3){
             $feestatus="Not Paid";
         }else{
            $feestatus="Paid";
         }
       
        $rec=$request->id;
         return view("home", ["branch_name"=> $branch_name, "bill_number"=>$bill_number,"bill_date"=> $bill_date,"due_date"=>$due_date,"first_name"=>$firstname,"last_name"=>$lastname,"address"=>$address,"reg_no"=>$reg_no,"phone"=>$phone,"class"=>$class,"feefor"=>$feeFor,"bill_month"=>$bill_month,"total"=>$total,"fine"=>$fine,"grand_total"=>$grand_total, "status"=>$status, "search"=>$rec,"fee_status"=>$feestatus ]);
        }
        else{
            $rec="";
            $status="Not Found After Search";
            return view("home", ["status"=>$status, "search"=>$rec]);
        }
        
       
        
        
        }
}




public function submitfee(Request $request){

    $total=$request->total;
    $fine=$request->total;
    $id= $request->id;
    $current=date("Y-m-d");

   $result= feeBills::where("receipt_no", $id)->update(["bankfine" => $fine, "paid_amount" => $total, "status"=>3, "received_date"=>$current]);

   if($result){
             $rec="";
            $status="Paid Successfull";
            return view("home", ["status"=>$status, "search"=>$rec]);
   }
   else{

    $rec="";
    $status="Error Not Paid";
    return view("home", ["status"=>$status, "search"=>$rec]);
   }
}


}
