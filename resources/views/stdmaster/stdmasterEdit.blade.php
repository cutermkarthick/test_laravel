@extends('newtemp.main')
@section('content')

	<?php 
		 $userid = session('user');
		 $dept = session('department');

		 $myrow = $details[0];
	?>

	{!!  Form::open(['action'=>'MasterController@submit_editstd' , 'class'=>'form']) !!}

	<form method="post" action="{{ action('MasterController@submit_editstd') }}" accept-charset="UTF-8">

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
            <td colspan="3"><span class="tabletext"><input type="text" name="standard_num" id="standard_num" size=20 value="{{$myrow->std_no}}"></span></td>
            
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
			$flag = 0;
		    while ($i<=3)
		    {
		    	if($flag==0)
   				{	
   					foreach($lidetails as $myrowli){
				      	$line_num="line_num" . $i;
						$status="status" . $i;
						$iss_date="iss_date" . $i;
						$iss_of_std="iss_of_std" . $i;
						$prevlinenum="prev_line_num" . $i;
						$lirecnum="lirecnum" . $i;
						$ncstate="ncstate".$i;
						$prev_iss_ref="prev_iss_ref".$i;

					?>
					<tr>
						<input type="hidden"  name="{{$prevlinenum}}"  value="{{$myrowli->line_num}}" size="6%" id="{{$prevlinenum}}">
						<input type="hidden"  name="{{$lirecnum}}"  value="{{$myrowli->recnum}}" size="6%" id="{{$lirecnum}}">
						<input type="hidden"  name="{{$prev_iss_ref}}" id="{{$prev_iss_ref}}"  value="" size="6%" id="{{$myrowli->iss_of_ref}}">

						<td ><span class="tabletext"><input type="text"  name="{{$line_num}}"  value="{{$myrowli->line_num}}" size="6%" id="{{$line_num}}"></span></td>
						<td ><span class="tabletext"><input type="text"  name="{{$iss_of_std}}"  value="{{$myrowli->iss_of_ref}}" size="15%" id="{{$iss_of_std}}"></span></td>
						<td ><span class="tabletext"><input type="text"  name="{{$iss_date}}"  value="{{$myrowli->iss_date}}" size="15%" id="{{$iss_date}}"></span></td>
						<td>
						<span class="tabletext"><input type="text"  name="{{$status}}"  value="{{$myrowli->status}}" size="15%" id="{{$status}}"></span>
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

					$flag = 1;
				}

				$line_num="line_num" . $i;
				$status="status" . $i;
				$iss_date="iss_date" . $i;
				$iss_of_std="iss_of_std" . $i;
				$prevlinenum="prev_line_num" . $i;
				$lirecnum="lirecnum" . $i;
				$ncstate="ncstate".$i;
				$prev_iss_ref="prev_iss_ref".$i;
				?>

				<tr>
					<input type="hidden"  name="{{$prevlinenum}}"  value="" size="6%" id="{{$myrowli->line_num}}">
					<input type="hidden"  name="{{$lirecnum}}"  value="" size="6%" id="{{$myrowli->recnum}}">


					<td ><span class="tabletext"><input type="text"  name="{{$line_num}}"  value="" size="6%" id="{{$line_num}}"></span></td>
					<td ><span class="tabletext"><input type="text"  name="{{$iss_of_std}}"  value="" size="15%" id="{{$iss_of_std}}"></span></td>
					<td ><span class="tabletext"><input type="text"  name="{{$iss_date}}"  value="" size="15%" id="{{$iss_date}}"></span></td>
					<td>
					<span class="tabletext"><input type="text"  name="{{$status}}"  value="{{$myrowli->status}}" size="15%" id="{{$status}}"></span>
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

			<input type="hidden"  name="index"  value="{{$i}}" size="6%" id="index">
			<input type="hidden"  name="recnum"  value="{{$myrow->recnum}}" size="6%" id="recnum">

	</table>

	<input type="submit" size="60" value="Submit"  class="btn btn-default" onclick="javascript: return check_req_fields()"/>

	{!! Form::close()  !!}

@stop