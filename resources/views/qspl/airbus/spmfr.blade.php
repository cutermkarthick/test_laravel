@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<tr><td><span class="heading"><i>Please click on the Recnum. to Edit</i></span></td></tr>

	{!!  Form::open(['url'=>'spmfr' , 'class'=>'form', 'method' => 'post']) !!}
	
	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">Ref No(PS)</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="refno_oper" size="1" width="50">
						<option value="like" <?php if($refno_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($refno_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="refno" size=15 value="{{$refno_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">ARP Id </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="arpid_oper" size="1" width="50">
						<option value="like" <?php if($arpid_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($arpid_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="arpid" size=15 value="{{$arpid_match}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Company Name </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="cmp_oper" size="1" width="50">
						<option value="like" <?php if($cmp_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($cmp_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="cmpname" size=15 value="{{$cmpname_match}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">City </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="city_oper" size="1" width="50">
						<option value="like" <?php if($city_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($city_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="city" size=15 value="{{$city_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Country </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="country_oper" size="1" width="50">
						<option value="like" <?php if($country_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($country_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="country" size=15 value="{{$country_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF" colspan=4></td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>QSPL Airbus Specs</b></span></td>
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
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>ARP id</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Company Name</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>City</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Country</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Ref No(PS)</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Tittle(PS)</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Ref No(PI)</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Tittle(PI)</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Special Process</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Limitation</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>From Date</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>To Date</b></span></td>
	    </tr>

	    @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->arp_id }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->company_name }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->city }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->country }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->ref_no }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->title }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->ref_no_pi }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->title_pi }} </span> </td>

			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->special_process }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->limitation }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->from_date }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->to_date }} </span> </td>
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