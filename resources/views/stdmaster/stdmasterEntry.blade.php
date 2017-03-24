@extends('newtemp.main')
@section('content')

	<?php 
		 $userid = session('user');
		 $dept = session('department');
	?>

	{!!  Form::open(['route'=>'submit_newstd' , 'class'=>'form']) !!}


	<script type="text/javascript">
      jQuery(document).ready(function($){
          $( "#iss_date1" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

          });
          $( "#iss_date2" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

          });

          $( "#iss_date3" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

          });

	    });

	</script>
	<script src="{{ asset('assets/scripts/stdmaster.js') }} "></script>

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<tr><td><span class="heading"><i>New STANDARD MASTER</i></span></td></tr>

	<table border=0 bgcolor="#DFDEDF" width=60% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=4 align="center"><span class="heading"><b>General Information</b></span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Standard #</p></span></td>
            <td colspan="3"><span class="tabletext"><input type="text" name="standard_num" id="standard_num" size=20 value=""></span></td>
            
        </tr>
  	</table>

  	<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr bgcolor="#EEEFEE">
			<td colspan=10><span class="heading"><center><b>Line Items</b></center></span></td>
		</tr>
			
		<tr>
			<td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Sl No</b></span></td>
			<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Iss Reference</b></span></td>
			<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Modified Date </b></span></td>
			<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Status</b></span></td>
		</tr>

		<?php
			$i=1;
		    while ($i<=3)
		    {
		      	$line_num="line_num" . $i;
				$status="status" . $i;
				$iss_date="iss_date" . $i;
				$iss_of_std="iss_of_std" . $i;
				$ncstate="ncstate".$i;
			?>

				<tr>
					<td ><span class="tabletext"><input type="text"  name="{{$line_num}}"  value="" size="6%" id="{{$line_num}}"></span></td>
					<td ><span class="tabletext"><input type="text"  name="{{$iss_of_std}}"  value="" size="15%" id="{{$iss_of_std}}"></span></td>
					<td ><span class="tabletext"><input type="text"  name="{{$iss_date}}"  value="" size="15%" id="{{$iss_date}}"></span></td>
					<td>
						<span class="tabletext"><input type="text"  name="{{$status}}"  value="" size="15%" id="{{$status}}"></span>
						<select name="{{$ncstate}}" id="{{$ncstate}}" onchange="onSelectStatus({{$i}})">
				          	<option value="Select" selected disabled>Please Specify</option>
				          	<option value="Active">Active</option>
				          	<option value="Inactive">Inactive</option>
			        	</select>
			      </td>
				</tr>

			<?php
		        $i++;
		    }
			?>

			<input type="hidden" name="index" id="index" value={{$i}}>
	</table>

	<input type="submit" size="60" value="Submit"  class="btn btn-default" onclick="javascript: return check_req_fields()"/>

	{!! Form::close()  !!}
@stop