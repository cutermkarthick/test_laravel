@extends('newtemp.main')
@section('content')
	<?php 
		$userid = session('user');
     $dept = session('department');
     $edept = session('department');
     $userrole = session('userrole');

     $myrow = $details[0];
     $today = date('Y-m-d') ;


	?>

	<script src="{{ asset('assets/scripts/master_route.js') }} "></script>
	<script type="text/javascript">
      jQuery(document).ready(function($){
          $( "#date" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

          });


    });

</script>

  {!!  Form::open(['route'=>'submit_newmrs' , 'class'=>'form']) !!}
  <table width=100% border=0 cellspacing="0" cellpadding="0" >
    <tr>
      <td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
      <td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
     </tr>
  </table>
  <br>

  <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
    <tr>
      <td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DOC #</p></span></td>
            <td><span class="tabletext"><input type="text" name="doc_id" id="doc_id" size=20 value=""></span></td>
            <td><span class="labeltext"><p align="left">Issue</p></span></td>
            <td><span class="labeltext"><input type="text" name="issue" id="issue" size=20 value="{{ $myrow->issue }}"></span></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Customer</p></font></td>
          <td><input type="text" name="customer" id="customer" size=20 value="{{ $myrow->customer }}">
          </td>
          <td><span class="labeltext"><p align="left">Date</p></font></td>
          <td><input type="text" name="date" id="date" size=20 value="{{ $myrow->date }}" >
          </td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Scope</p></font></td>
          <td><textarea name="scope" id="scope" cols="50" rows="3">{{ $myrow->scope }}</textarea></td>
          <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
          <td><textarea name="response" id="response" cols="50" rows="3">{{ $myrow->response }}</textarea>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Reference</p></font></td>
            <td><textarea name="reference" id="reference" cols="50" rows="3">{{ $myrow->reference }}</textarea></td>
            <td></td>
            <td colspan="3"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=10><span class="heading"><center><b>Add Notes</b></center></td>
      </tr>

      <tr bgcolor="#FFFFFF">
        <td colspan=8><textarea name="notes" id="notes" rows="3" cols="81" value=""></textarea></td> 
      </tr>
  </table>

  <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
      <tr bgcolor="#EEEFEE">
        <td colspan=10><span class="heading"><center><b>MRS Line Items</b></center></span></td>
      </tr>
      <tr>
        <td colspan=10>
          <a href="javascript:addRow('myTable',document.forms[0].index.value)" ><button type="button" class="btn btn-default" >AddRow</button>
          </a>
      </tr>
    <tr>
      <td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Line Num</b></span></td>
      <td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>OP NO</b></span></td>
      <td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Descriptions </b></span></td>
      <td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Spec</b></span></td>
      <td bgcolor="#EEEFEE" width=7% align="center"><span class="heading"><b>Std Iss</b></span></td>
      <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>PS NO</b></span></td>
      <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>PS Iss #</b></span></td>
      <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Cofc Display</b></span></td>
      <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Dept</b></span></td>
    </tr> 

    <?php
      $i=1;
      $flag=0;
      while ($i<5  && $flag==0)
      {
        if($flag==0)
        {
          foreach($lidetails as $myrowli)
          {
            $line_num = "line_num" .$i;
            $op_no = "op_no" .$i;
            $desc = "desc" .$i;
            $spec = "spec" .$i;
            $ps_no = "ps_no" .$i;
            $dept = "dept" .$i;
            $display = "display" .$i;
            $std_iss = "std_iss" .$i;
            $ps_recnum = "ps_recnum" .$i;
            $ps_issue = "ps_issue" .$i;

          ?>
            <tr>

              <td ><span class="tabletext"><input type="text"  name="{{$line_num}}"  value="{{$myrowli->linenum}}" size="4%" id="{{$line_num}}"></td>
              <td ><span class="tabletext"><input type="text"  name="{{$op_no}}"  value="{{$myrowli->op_num}}" size="10%" id="{{$op_no}}"></td>
              <td ><span class="tabletext"><input type="text"  name="{{$desc}}"  value="{{$myrowli->desc}}" size="60%" id="{{$desc}}"></td>
              <td >
                <span class="tabletext"><input type="text"  name="{{$spec}}"  value="{{$myrowli->spec}}" size="20%" id="{{$spec}}" style="background-color:#DDDDDD;" readonly="readonly"></span>
                <img src="{{asset('assets/images/bu-get.gif') }}" onclick="getspec4mrs({{$i}})">
              </td>
              <td ><span class="tabletext"><input type="text"  name="{{$std_iss}}"  value="{{$myrowli->std_iss_ref}}" size="5%" id="{{$std_iss}}" style="background-color:#DDDDDD;" readonly="readonly"></td>
              <td >
                <span class="tabletext"><input type="text"  name="{{$ps_no}}"  value="{{$myrowli->ps_no}}" size="10%" id="{{$ps_no}}" style="background-color:#DDDDDD;" readonly="readonly">
                <img src="{{asset('assets/images/bu-get.gif') }}" onclick="getprocess_sheet({{$i}})">
              </td>
              <td ><span class="tabletext"><input type="text"  name="{{$ps_issue}}"  value="{{$myrowli->ps_issue}}" size="10%" id="{{$ps_issue}}" style="background-color:#DDDDDD;" readonly="readonly"></td> 

              <input type="hidden"  name="{{$ps_recnum}}" id="{{$ps_recnum}}" value="{{$myrowli->recnum}}" size="10%">

              <td>
                <select id="{{$display}}" name="{{$display}}">
                  <option value="yes" <?php if($myrowli->display == "yes") {echo "selected='selected'"; } ?>>Yes</option>
                  <option value="no" <?php if($myrowli->display == "no") {echo "selected='selected'"; } ?>>No</option>
                </select>
              </td>

              <td>
                <select name="{{$dept}}" id="{{$dept}}" width="100" >
                  <option value="ppc" <?php if($myrowli->dept == "ppc") {echo "selected='selected'"; } ?>>PPC</option>
                  <option value="stores" <?php if($myrowli->dept == "stores") {echo "selected='selected'"; } ?>>Stores</option>
                  <option value="qa" <?php if($myrowli->dept == "qa") {echo "selected='selected'"; } ?> >QA</option>
                  <option value="fpi" <?php if($myrowli->dept == "fpi") {echo "selected='selected'"; } ?>>FPI</option>
                  <option value="mpi" <?php if($myrowli->dept == "mpi") {echo "selected='selected'"; } ?>>MPI</option>
                  <option value="prodn" <?php if($myrowli->dept == "prodn") {echo "selected='selected'"; } ?> >Prodn</option>
                  <option value="paint" <?php if($myrowli->dept == "paint") {echo "selected='selected'"; } ?> >Paint</option>
                </select>
              </td>

            </tr>
            <?
              $i++;
            }
          }

        $flag = 1;
      }

      while($i<=10)
      { 

        $line_num = "line_num" .$i;
        $op_no = "op_no" .$i;
        $desc = "desc" .$i;
        $spec = "spec" .$i;
        $ps_no = "ps_no" .$i;
        $dept = "dept" .$i;
        $std_iss = "std_iss" .$i;
        $display = "display" .$i;
        $ps_recnum = "ps_recnum" .$i;
        $ps_issue = "ps_issue" .$i;
      ?>

        <tr>
              
              <td ><span class="tabletext"><input type="text"  name="{{$line_num}}"  value="" size="4%" id="{{$line_num}}"></td>
              <td ><span class="tabletext"><input type="text"  name="{{$op_no}}"  value="" size="10%" id="{{$op_no}}"></td>
              <td ><span class="tabletext"><input type="text"  name="{{$desc}}"  value="" size="60%" id="{{$desc}}"></td>
              <td >
                <span class="tabletext"><input type="text"  name="{{$spec}}"  value="" size="20%" id="{{$spec}}" style="background-color:#DDDDDD;" readonly="readonly"></span>
                <img src="{{asset('assets/images/bu-get.gif') }}" onclick="getspec4mrs({{$i}})">
              </td>
              <td ><span class="tabletext"><input type="text"  name="{{$std_iss}}"  value="" size="5%" id="{{$std_iss}}" style="background-color:#DDDDDD;" readonly="readonly"></td>
              <td >
                <span class="tabletext"><input type="text"  name="{{$ps_no}}"  value="" size="10%" id="{{$ps_no}}" style="background-color:#DDDDDD;" readonly="readonly">
                <img src="{{asset('assets/images/bu-get.gif') }}" onclick="getprocess_sheet({{$i}})">
              </td>
              <td ><span class="tabletext"><input type="text"  name="{{$ps_issue}}"  value="" size="10%" id="{{$ps_issue}}" style="background-color:#DDDDDD;" readonly="readonly"></td> 
              <input type="hidden"  name="{{$ps_recnum}}" id="{{$ps_recnum}}" value="{{$myrowli->recnum}}" size="10%">

              <td>
                <select name="{{$display}}" id="{{$display}}">
                  <option value="Yes" >Yes</option>
                  <option value="No" selected>No</option>
                </select>
              </td>

              <td>
                <select name="{{$dept}}" id="{{$dept}}">
                  <option value="ppc" selected>PPC</option>
                  <option value="stores">Stores</option>
                  <option value="qa">QA</option>
                  <option value="fpi">FPI</option>
                  <option value="mpi">MPI</option>
                  <option value="prodn">Prodn</option>
                  <option value="paint">Paint</option>
                  <option value="CT">CT</option>
                </select>
              </td>

            </tr>

      <?php
        $i++;
      }

      ?>

    <input type="hidden" name= "index" id="index" value="{{$i}}">
    <input type="hidden" name= "curindex" value="{{$i}}">
    <input type="hidden" id="dept" name="dept" value="{{ $dept }}">
    <input type="hidden" id="pagename" name="pagename" value="newmaster_routing">
  </table>

<input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields4New()"/>

{!! Form::close()  !!}
@stop