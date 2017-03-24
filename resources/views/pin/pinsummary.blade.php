@extends('newtemp.main')
@section('content')

	<?php 
		 $userid = session('user');
		 $dept = session('department');
	?>


			<table width=100% border=0 cellspacing="0" cellpadding="0" >
				<tr>
					<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
					<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
				 </tr>
			</table>

			{!!  Form::open(['url'=>'pinsummary' , 'class'=>'form', 'method' => 'post']) !!}

			<tr><td><span class="heading"><i>Please click on the Process ID to Edit/Delete</i></span></td></tr>

			<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
				<tr>
					<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
					<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
					<button  class="btn btn-default" type="submit">Search</button>
					</td>
				</tr>

				<tr>

					<td bgcolor="#FFFFFF"><span class="labeltext">Process ID</span></td>
					<td bgcolor="#FFFFFF">
						<span class="tabletext">
							<select name="pin_oper" size="1" width="50">
								<option value="like" <?php if($pin_oper == "like"){echo "selected='selected'";}?>>Like</option>
								<option value="=" <?php if($pin_oper == "="){echo "selected='selected'";}?>>=</option>
							</select>
						</span>
					</td>
					<td bgcolor="#FFFFFF"><input type="text" name="cim" size=15 value="{{$cim_match}}" onkeypress="javascript: return checkenter(event)"></td>

					<td bgcolor="#FFFFFF"><span class="labeltext">MRS # </span></td>
					<td bgcolor="#FFFFFF">
						<span class="tabletext">
							<select name="mrs_oper" size="1" width="50">
								<option value="like" <?php if($mrs_oper == "like"){echo "selected='selected'";}?>>Like</option>
								<option value="=" <?php if($mrs_oper == "="){echo "selected='selected'";}?>>=</option>
							</select>
						</span>
					</td>
					<td bgcolor="#FFFFFF"><input type="text" name="mrs_num" size=15 value="{{$mrs_match}}" onkeypress="javascript: return checkenter(event)"></td>

				
					<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b></span></td>
					<td bgcolor="#FFFFFF" colspan=3>
						<span class="tabletext">
				  		<select name="condition" size="1" > 
				  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
				  			<option value="Active" <?php if($sval == "Active"){ echo "selected= 'selectd'"; } ?>>Active</option>
				  			<option value="Pending" <?php if($sval == "Pending"){ echo "selected= 'selectd'"; } ?>>Pending</option>
				  			<option value="Inactive" <?php if($sval == "Inactive"){ echo "selected= 'selectd'"; } ?>>Inactive</option>
				  			<option value="Cancelled" <?php if($sval == "Cancelled"){ echo "selected= 'selectd'"; } ?>>Cancelled</option>
				  		</select>
			  		</span>
					</td>
				</tr>

				<tr>
					<td bgcolor="#FFFFFF"><span class="labeltext">Customer </span></td>
					<td bgcolor="#FFFFFF">
						<span class="tabletext">
							<select name="cust_oper" size="1" width="50">
								<option value="like" <?php if($cust_oper == "like"){echo "selected='selected'";}?>>Like</option>
								<option value="=" <?php if($cust_oper == "="){echo "selected='selected'";}?>>=</option>
							</select>
						</span>
					</td>
					<td bgcolor="#FFFFFF"><input type="text" name="customer" size=15 value="{{$cust_match}}" onkeypress="javascript: return checkenter(event)"></td>

					<td bgcolor="#FFFFFF" colspan=4></td>
					<td bgcolor="#FFFFFF" colspan=4></td>

				</tr>

			</table>

			<table width="100%" border="0" cellspacing="1" cellpadding="6">
				<tr>
					<td><span class="heading"><b>List of PIN Masters</b></span></td>
					@if($dept == 'Sales' || $dept == 'ENG')
					<td align="right">
						<a class="btn btn-default" href="newpinmaster" role="button">New</a>
					</td>
					@endif
				</tr>
			</table>
			<br>

			<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
			    <tr>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Process ID</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>MRS #</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>MRS Issue</b></span></td>
			        <td width="20%" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Customer</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>RM Type</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Status</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Type</b></span></td>
			    </tr>

			    
			    @foreach ($results as $myrow)
		    	<tr>
				    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->CIM_refnum }}</a></span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->bomnum }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->mrissue }}  </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partname }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partnum }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->customer }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->rm_type }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->pin_type }} </span> </td>
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


