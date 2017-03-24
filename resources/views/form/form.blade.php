@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<tr><td><span class="heading"><i>Please click on the Recnum. to Edit</i></span></td></tr>

	{!!  Form::open(['url'=>'form' , 'class'=>'form', 'method' => 'post']) !!}

		<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
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

			<td bgcolor="#FFFFFF"><span class="labeltext">Part # </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="partnum_oper" size="1" width="50">
						<option value="like" <?php if($partnum_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($partnum_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="partnum" size=15 value="{{$partnum}}" onkeypress="javascript: return checkenter(event)"></td>

		
			
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Part Name </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="partname_oper" size="1" width="50">
						<option value="like" <?php if($partname_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($partname_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="partname" size=15 value="{{$partname}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Fair # </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="fairnum_oper" size="1" width="50">
						<option value="like" <?php if($fairnum_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($fairnum_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="fairnum" size=15 value="{{$fairnum}}" onkeypress="javascript: return checkenter(event)"></td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Form Summary</b></span></td>
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
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Fair #</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Serial #</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO #</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO Line #</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Signature</b></span></td>
          	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></span></td>
	    </tr>

	     @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partnum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partname }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->fairno }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->serialnum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->ponum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->po_linenum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->sign_by }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->sign_date }} </span> </td>

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


