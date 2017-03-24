@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'cons_grn' , 'class'=>'form', 'method' => 'post']) !!}

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

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Master Type</span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="type" size="1" > 
		  			<option value="All" <?php if($type == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="Paint" <?php if($type == "Paint"){ echo "selected= 'selectd'"; } ?>>Paint</option>
		  			<option value="Chemical" <?php if($type == "Chemical"){ echo "selected= 'selectd'"; } ?>>Chemical</option>
		  			<option value="Hardner" <?php if($type == "Hardner"){ echo "selected= 'selectd'"; } ?>>Hardner</option>
		  			<option value="Thinner" <?php if($type == "Thinner"){ echo "selected= 'selectd'"; } ?>>Thinner</option>
		  		</select>
	  		</span>
			</td>
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Status </span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="status" size="1" > 
		  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="Open" <?php if($sval == "Open"){ echo "selected= 'selectd'"; } ?>>Open</option>
		  			<option value="Closed" <?php if($sval == "Closed"){ echo "selected= 'selectd'"; } ?>>Closed</option>
		  			<option value="Processed" <?php if($sval == "Processed"){ echo "selected= 'selectd'"; } ?>>Processed</option>
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

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
		<tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN No.</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Code</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inv #</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Dt</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Master Type</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Recd</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Issued</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Balance</b></span></td>
        </tr>

        @foreach ($results as $myrow)
    	<tr>
		    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->grnnum }}</a></span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->name }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->raw_mat_spec }}  </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->raw_mat_code }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->invoice_num }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  @if(($myrow->invoice_date != "0000-00-00") &&  ($myrow->invoice_date != "") ) {{ Carbon\Carbon::parse($myrow->invoice_date)->format('M d, Y') }} @endif  </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->master_type }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qtm }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty_used }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->balance }} </span> </td>
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