@extends('newtemp.main')
@section('content')


	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<tr><td><span class="heading"><i>Please click on the Seq ID to Edit/Delete</i></span></td></tr>

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">MFG ID</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="mfg_oper" size="1" width="50">
						<option value="like" <?php if($mfg_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($mfg_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="mfg_id" size=15 value="{{$mfg_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">PS # </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="ps_oper" size="1" width="50">
						<option value="like" <?php if($ps_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($ps_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="ps" size=15 value="{{$ps_match}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b></span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="condition" size="1" > 
		  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="Open" <?php if($sval == "Open"){ echo "selected= 'selectd'"; } ?>>Open</option>
		  			<option value="Issued" <?php if($sval == "Issued"){ echo "selected= 'selectd'"; } ?>>Issued</option>
		  			<option value="Closed" <?php if($sval == "Closed"){ echo "selected= 'selectd'"; } ?>>Closed</option>
		  			<option value="Cancelled" <?php if($sval == "Cancelled"){ echo "selected= 'selectd'"; } ?>>Cancelled</option>
		  		</select>
	  		</span>
			</td>
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Seq # </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="seq_oper" size="1" width="50">
						<option value="like" <?php if($seq_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($seq_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="recnum" size=15 value="{{$seq_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF" colspan=4></td>
			<td bgcolor="#FFFFFF" colspan=4></td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>List of MFG Orders</b></span></td>
			@if($dept == 'Sales' || $dept == 'ENG')
			<td align="right">
				<a class="btn btn-default" href="newpinmaster" role="button">New</a>
			</td>
			@endif
		</tr>
	</table>
	<br>

	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
        <tr bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Seq #</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>MFG #</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PS #</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></span></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></span></td>
        </tr>

        @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->mfg_id }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->tanknum }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->orderdate }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->mfg_desc }} </span> </td>
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