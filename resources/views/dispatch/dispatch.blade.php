@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<tr><td><span class="heading"><i>Please click on the Recnum. to Edit</i></span></td></tr>

	{!!  Form::open(['url'=>'dispatch' , 'class'=>'form', 'method' => 'post']) !!}

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
			<td bgcolor="#FFFFFF"><input type="text" name="recnum" size=15 value="{{$recnum}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">	Cofc # </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="cofc_oper" size="1" width="50">
						<option value="like" <?php if($cofc_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($cofc_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="cust_cofc_no" size=15 value="{{$cust_cofc_no}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Pin # </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="pinum_oper" size="1" width="50">
						<option value="like" <?php if($pinum_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($pinum_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="pinnum" size=15 value="{{$pinnum}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Cofc Summary</b></span></td>
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
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Seq #</b></span></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer Name</b></span></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer Cofc No</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Wo No</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO No</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PIN No</b></span></td>
	    </tr>

	    @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->name }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->cust_cofc_no }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->wo_no }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->po_no }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->qty }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->pin_no }} </span> </td>


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