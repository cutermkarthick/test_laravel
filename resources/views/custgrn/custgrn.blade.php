@extends('newtemp.main')
@section('content')



	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'custgrn' , 'class'=>'form', 'method' => 'post']) !!}

	<tr><td><span class="heading"><i>Please click on the grnnum to Edit/Delete</i></span></td></tr>

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">GRN No</span></td>
			<td bgcolor="#FFFFFF"><input type="text" name="grnnum" size=15 value="{{$grn_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Supplier </span></td>
			<td bgcolor="#FFFFFF"><input type="text" name="supplier" size=15 value="{{$supp_match}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">PIN No </span></td>
			<td bgcolor="#FFFFFF"><input type="text" name="pinnum" size=15 value="{{$pin_match}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Status </span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="status" size="1" > 
		  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="Open" <?php if($sval == "Open"){ echo "selected= 'selectd'"; } ?>>Open</option>
		  			<option value="Closed" <?php if($sval == "Closed"){ echo "selected= 'selectd'"; } ?>>Closed</option>
		  			<option value="Pending" <?php if($sval == "Pending"){ echo "selected= 'selectd'"; } ?>>Pending</option>
		  			<option value="Cancelled" <?php if($sval == "Cancelled"){ echo "selected= 'selectd'"; } ?>>Cancelled</option>
		  		</select>
	  		</span>
			</td>

			<td bgcolor="#FFFFFF" colspan=4></td>
			<td bgcolor="#FFFFFF" colspan=4></td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>List of GRN's</b></span></td>
			
		</tr>
	</table>
	<br>	

			

			<div id="forum4" class="panel-collapse collapse in" style="height:370px;">   
				<div class="table-responsive" style="display:block;overflow:auto;max-height:370px;">

				<table  width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-fixed" >
					<thead>
					<tr  bgcolor="#FFCC00">
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN No.</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer Part #</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer PO #</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PIN #</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Booked Date</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Recd.</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Corr Qty</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Disp Qty</b></span></td>
			            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Issued</b></span></td>
			        </tr>
			        </head>
			        <tbody>
				        @foreach ($results as $myrow)
				        <tr>
				        	<td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->grnnum }}</a></span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->name }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->cust_part_no }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->cust_po_num }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->pin_no }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->book_date }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty_corr }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty_disp }} </span> </td>
				        	<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty_disp }} </span> </td>
			       		</tr>
			        	@endforeach
			       	</tbody>
		   			</table>
				</div>
			</div>

		<br>


    @if($totpages != 0)
		<span class="labeltext"> <?php echo $first.' ' . $prev;?>  Showing page <strong>{{ $pageNum }} </strong> of <strong>{{ $totpages }}</strong> pages <?php echo $next.' ' . $last;?> </span>
	@else
		<span class="labeltext" style="text-align: center;">No matching records found</center>
	@endif

	{!! Form::close() !!}
@stop