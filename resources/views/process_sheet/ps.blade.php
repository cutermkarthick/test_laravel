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

			{!!  Form::open(['url'=>'bom' , 'class'=>'form', 'method' => 'post']) !!}

			<tr><td><span class="heading"><i>Please click on the PS link for details or to Edit/Delete</i></span></td></tr>

			<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
				<tr>
					<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></span></td>
					<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></span></td>
					<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
					<button  class="btn btn-default" type="submit">Search</button>
					</td>
				</tr>

				<tr>
					<td bgcolor="#FFFFFF"><span class="labeltext">PS #</span></td>
					<td bgcolor="#FFFFFF">
						<span class="tabletext">
							<select name="oper" size="1" width="50">
								<option value="like" <?php if($oper == "like"){echo "selected='selected'";}?>>Like</option>
								<option value="=" <?php if($oper == "="){echo "selected='selected'";}?>>=</option>
							</select>
						</span>
					</td>
					<td bgcolor="#FFFFFF"><input type="text" name="bom" size=15 value="{{$bom}}" onkeypress="javascript: return checkenter(event)"></td>

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
			</table>


		

			<table width="100%" border="0" cellspacing="1" cellpadding="6">
				<tr>
					<td><span class="heading"><b>List of Process sheets</b></span></td>
					@if($dept == 'Sales' || $dept == 'ENG')
					<td align="right">
						<a class="btn btn-default" href="newps" role="button">New</a>
					</td>
					@endif
				</tr>
			</table>
			<br>
			<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
			    <tr>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>PS #</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Iss #</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Date</b></span></td>
			        <td width="50%" bgcolor="#EEEFEE"><span class="heading"><b>Description</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Responsibility</b></span></td>
			        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Status</b></span></td>
			    </tr>

			    
			    @foreach ($results as $myrow)
		    	<tr>
				    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('ps_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->bomnum }}</a></span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->issue }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->psdate }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">   <?php echo wordwrap($myrow->bomdescr,60,"<br>\n")?> </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->fname }} </span> </td>
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