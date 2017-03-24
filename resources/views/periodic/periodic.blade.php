@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'periodic' , 'class'=>'form', 'method' => 'post']) !!}

	<tr><td><span class="heading"><i>Please click on the Seq. to view Details</i></span></td></tr>

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=2  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">Seq #</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="rec_oper" size="1" width="50">
						<option value="like" <?php if($rec_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($rec_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="recnum" size=15 value="{{$recnum_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Subprocess/Tank Num </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="proc_oper" size="1" width="50">
						<option value="like" <?php if($proc_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($proc_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="procname" size=15 value="{{$proc_match}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Subprocess/Tank Name  </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="subproc_oper" size="1" width="50">
						<option value="like" <?php if($subproc_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($subproc_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="sub_procname" size=15 value="{{$subproc_match}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Periodic Summary</b></span></td>
			<td align="right">
				<a class="btn btn-default" href="newpinmaster" role="button">New</a>
			</td>
		</tr>
	</table>
	<br>

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
	    <tr>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Seq #</b></span></td>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Process</b></span></td>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></span></td>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Sub Process</b></span></td>
	        <td width="20%" bgcolor="#EEEFEE"><span class="heading"><b>Frequency</b></span></td>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Periodic Test</b></span></td>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Customer Ref.</b></span></td>
	        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Procedure Ref</b></span></td>
	    </tr>

	     <?php 
	    	$prevnum = '';
	        $flag = 0;

	     
	        foreach($results as $key => $myrow)
	        { 
	    	?> 
	    		@if ($prevnum != $myrow->recnum) 

	    		<tr>
	    			<td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->procname }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->part_num }}  </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->sub_procname }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->frequency }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->periodic_test }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->customer_ref }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->procedure_ref }} </span> </td>
				</tr>
	    		@elseif ($prevnum == $myrow->recnum) 
	    		<tr>
	    			<td bgcolor="#FFFFFF"><span class="tabletext"></span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">   </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->frequency }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->periodic_test }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->customer_ref }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->procedure_ref }} </span> </td>
				</tr>
	    		@endif

	    	<?php
	        	$prevnum = $myrow->recnum;
    		}
	        ?>

	</table>

	@if($totpages != 0)
    		<span class="labeltext"> <?php echo $first.' ' . $prev;?>  Showing page <strong>{{ $pageNum }} </strong> of <strong>{{ $totpages }}</strong> pages <?php echo $next.' ' . $last;?> </span>
	@else
		<span class="labeltext" style="text-align: center;">No matching records found</center>
	@endif

	{!! Form::close() !!}
	
@stop