@extends('newtemp.main')
@section('content')


	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'testmatrix' , 'class'=>'form', 'method' => 'post']) !!}

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
					<select name="tank_oper" size="1" width="50">
						<option value="like" <?php if($tank_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($tank_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="tank_num" size=15 value="{{$tank_match}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Subprocess/Tank Name  </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="tname_oper" size="1" width="50">
						<option value="like" <?php if($tname_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($tname_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="tank_name" size=15 value="{{$tankname_match}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Test Matrix Summary</b></span></td>
			<td align="right">
				<a class="btn btn-default" href="newpinmaster" role="button">New</a>
			</td>
		</tr>
	</table>
	<br>

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
	    <tr>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Seq #</b></span></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Process</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Subproc <br>Tank Num</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Subproc <br>Tank Name</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Constituent</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Spec <br>Low</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Target <br>Low</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Target <br>High</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Spec <br>High</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Unit</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Frequency</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>ATPL Proc <br>Ref</b></span></td>
           	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Reminder</b></span></td>
	    </tr>

	    <?php 
	    	$prevnum = '';
	        $flag = 0;
	        $empty = "";
	        $reminder = "";
	     
	        foreach($results as $key => $myrow)
	        { 
	    	?>    
	        	@if ($prevnum != $myrow->recnum) 
				 
				<tr>
				    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->procname }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->tank_num }}  </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->tank_name }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->constituent }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->spec_low }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->target_low }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->target_high }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->spec_high }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->unit }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->analysis_freq }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->atpl_proc_ref }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $reminder }} </span> </td>
			    </tr>
				
				@elseif ($prevnum == $myrow->recnum) 
					
				<tr>
				    <td bgcolor="#FFFFFF"><span class="tabletext">   </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">   </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">   </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->tank_name }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->constituent }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->spec_low }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->target_low }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->target_high }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->spec_high }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->unit }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->analysis_freq }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->atpl_proc_ref }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $reminder }} </span> </td>
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