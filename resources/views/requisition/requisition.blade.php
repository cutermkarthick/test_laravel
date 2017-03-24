@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'requisition' , 'class'=>'form', 'method' => 'post']) !!}

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

			<td bgcolor="#FFFFFF"><span class="labeltext">Part Number </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="partnum_oper" size="1" width="50">
						<option value="like" <?php if($partnum_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($partnum_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="partnum" size=15 value="{{$partnum_match}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Batchnum  </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="batchnum_oper" size="1" width="50">
						<option value="like" <?php if($batchnum_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($batchnum_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="batchnum" size=15 value="{{$batchnum_match}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Requisition Summary</b></span></td>
			<td align="right">
				<a class="btn btn-default" href="newpinmaster" role="button">New</a>
			</td>
		</tr>
	</table>
	<br>

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
	    <tr>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Seq #</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum Req</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Req</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Units</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Tank #</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Expiry Date</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
	    </tr>

	    @foreach($results as $myrow)
		    <tr>
		    	<td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partnum_req }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->grn }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty_req }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->units }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->tanknum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->expiry_date }} </span> </td>
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