@extends('newtemp.main')
@section('content')
	<?php 
		$userid = session('user');
		$userid = Session::get('user');
	?>

	{!!  Form::open(['route'=>'submit_newps' , 'class'=>'form']) !!}

	<script src="{{ asset('assets/scripts/bom.js') }} "></script>
	<script type="text/javascript">
    var tanks= <?php echo json_encode($list_tanks ); ?>;
 	</script>
    <script type="text/javascript">
      
        jQuery(document).ready(function($){
          $( "#datepicker" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

          });


    });

</script>

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
			<td><span class="labeltext"><p align="left">*PS #</p></span></td>
			<td ><input type="text" size=25  name="bomnum" id="bomnum" value=""  ></td>

			<td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
			<td><input type="text" name="bomdate" id="datepicker"  size=25 value="" class="datepicker"></td>
		</tr>

		<tr bgcolor="#FFFFFF">
      <td><span class="labeltext"><p align="left">PS Name</p></span></td>
      <td><input type="text" size=35 name="type" value=""  ></td>
      <td><span class="labeltext"><p align="left">Scope</p></span></td>
      <td><textarea name="desc" rows="4" cols="40" ></textarea>
      </td>      
    </tr>

    <tr bgcolor="#FFFFFF">
      <td>
      	<span class="labeltext"><p align="left">Responsibility</p></span></td>
      <td>
      <input type="text" name="se"  id="se"  size=25 value="" style="background-color:#DDDDDD;" readonly="readonly">
      <button type="button" class="btn btn-default" onclick="GetAllEmps1()">Get Employee</button>
      </td>
      <td><span class="labeltext"><p align="left">Issue</p></span></td>
      <td><input type="text" size=25 name="issue" value="" ></td>
    </tr>

    <tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>Add Notes</b></center></td>
		</tr>

		<tr bgcolor="#FFFFFF">
      <td colspan=8><textarea name="notes" id="notes" rows="3" cols="81" value=""></textarea></td> 
    </tr>

  </table>

  <input type="hidden" name= "aerecnum" value="0">
	<input type="hidden" name= "serecnum" value="0">
	<input type="hidden" name= "pagename" id="pagename" value="newbom">

  <table>
    <tr bgcolor="#FFFFFF">
      	<td colspan=10><a href="javascript:addRow('myTable',document.forms[0].index.value)" ><button type="button" class="btn btn-default" >AddRow</button></a>
  	</tr>
  </table>
  <br>
	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered" id="myTable">
		<tr>
			<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
			<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Description</b></td>
			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Subprocess </b></td>
			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Tank # </b></td>
			<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Param Name</b></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Min</b></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Max</b></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty Check</b></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Paint Check</b></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Time Check</b></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Form 2</b></td>
			<td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Additional Instrns</b></td>
			<td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Instructions</b></td>
		</tr>

		<?php

 			$i=1;
      while ($i<=5)
      {

        $linenumber="linenum" . $i;
        $itemdesc="itemdesc" . $i;
        $itemname="itemname" . $i;
        $value="value" . $i;
        $ps_tanknum="ps_tanknum" . $i;
        $mfr="mfr" . $i;
        $mfrpn="mfrpn" . $i;
        $supplier="supplier" . $i;
        $qty="qty" . $i;
        $rate="rate" . $i;
        $amount="amount" . $i;
        $comments="comments" . $i;
        $optemp_min="optemp_min" . $i;
        $optemp_max="optemp_max" . $i;
        $immtime_min="immtime_min" . $i;
        $immtime_max="immtime_max" . $i;
        $vendrecnum="vendrecnum" . $i;
        $partrecnum="partrecnum" . $i;
        $workcenter="workcenter" . $i;
        $qty_check = "qty_check" . $i;
        $paint_check = "paint_check" . $i;
        $time_check = "time_check" . $i;
        $form2 = "form2_" . $i;
      ?>

      <tr>
      	<td ><span class="tabletext"><input type="text"  name="{{$linenumber}}"  value="" size="2%" id="{{$linenumber}}"></td>
       	<td><input type="text" name="{{$itemdesc}}" id="{{$itemdesc}}" size="35%" value=""></td>
	     	<td><input type="text" name="{{$value}}" id="{{$value}}" size="20%" value=""></td>

        <td>
        	<select name="{{$ps_tanknum}}" id="{{$ps_tanknum}}">
	          <option value="please select" selected disabled>Please select</option>
	          <option value="0" >NA</option>
	          @foreach ($list_tanks as $tanks)
	          	<option value="{{$tanks->recnum}}">{{$tanks->tank_num}}</option>
	          @endforeach
       		</select>
       	</td>

        <td><input type="text" name="{{$itemname}}" id="{{$itemname}}" size="20%" value=""></td>
        <td><input type="text" name="{{$optemp_min}}"  id="{$optemp_min}" size="4%" value=""></td>
        <td><input type="text" name="{{$optemp_max}}" id="{{$optemp_max}}" size="4%" value=""></td>
        <td><select name="{{$qty_check}}" id="{{$qty_check}}">
          <option value="Yes" >Yes</option>
          <option value="No" selected>No</option></select></td>
        <td><select name="{{$paint_check}}" id="{{$paint_check}}">
          <option value="Yes" >Yes</option>
          <option value="No" selected>No</option></select></td>
       <td><select name="{{$time_check}}" id="{{$time_check}}">
          <option value="Yes" >Yes</option>
          <option value="No" selected>No</option></select></td>


        <td><select name="{{$form2}}" id="{{$form2}}">
          <option value="Yes" >Yes</option>
          <option value="No" selected>No</option></select></td>
      
        <td><input type="text" name="{{$workcenter}}" id="{{$workcenter}}" size="40%" value=""></td>    
        <td><input type="text" name="{{$comments}}" id="{{$comments}}" size="40%" value=""></td>

      </tr>
      <?php 
				 $i++;
    	}
			?>
		  <input type="hidden" name= "index" id="index" value="{{$i}}">
		  <input type="hidden" name= "curindex" value="{{$i}}">
	</table>

	<input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields()"/>

	{!! Form::close() !!}
@stop