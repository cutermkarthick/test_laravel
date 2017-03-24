@extends('newtemp.main')
@section('content')

	<?php 
		 $userid = session('user');
		 $dept = session('department');
	?>

	{!!  Form::open(['url'=>'stdmaster_summary' , 'class'=>'form', 'method' => 'post']) !!}
	
	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<tr><td><span class="heading"><i>Please click on the Standard# link for details or to Edit</i></span></td></tr>

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=2  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Standard No</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="refno_oper" size="1" width="50">
						<option value="like" <?php if($refno_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($refno_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="{{ $final_refno }}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b></span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="status_val" size="1" > 
		  			<option value="All" <?php if($status_val == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="Active" <?php if($status_val == "Active"){ echo "selected= 'selectd'"; } ?>>Active</option>
		  			<option value="Inactive" <?php if($status_val == "Inactive"){ echo "selected= 'selectd'"; } ?>>Inactive</option>
		  		</select>
	  		</span>
			</td>
		</tr>
	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>List Of SP Treatment Master</b></span></td>
			
			<td align="right">
				<a class="btn btn-default" href="newstd" role="button">New</a>
			</td>
			
		</tr>
	</table>
	<br>

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
    <tr>
        <td width="20%" bgcolor="#EEEFEE"><span class="heading"><b>Standard #</b></span></td>
        <td width="15%" bgcolor="#EEEFEE"><span class="heading"><b>Iss Ref</b></span></td>
        <td width="15%" bgcolor="#EEEFEE"><span class="heading"><b>Modified Date</b></span></td>
        <td width="15%" bgcolor="#EEEFEE"><span class="heading"><b>Status</b></span></td>        
    </tr>

	@foreach ($results as $myrow)
    	<tr>
		    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('std_edit', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->std_no }}</a></span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->iss_of_ref }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  @if($myrow->iss_date != "0000-00-00") {{ Carbon\Carbon::parse($myrow->iss_date)->format('M d, Y') }} @endif  </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>		    
	    </tr>
    @endforeach

    </table>

    @if($totpages != 0)
		<span class="labeltext"> <?php echo $first.' ' . $prev;?>  Showing page <strong>{{ $pageNum }} </strong> of <strong>{{ $totpages }}</strong> pages <?php echo $next.' ' . $last;?> </span>
  	@else
  		<span class="labeltext" style="text-align: center;">No matching records found</center>
  	@endif

  	{!! Form::close() !!}

@stop