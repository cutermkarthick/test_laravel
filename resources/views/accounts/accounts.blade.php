@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'accounts' , 'class'=>'form', 'method' => 'post']) !!}

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=2  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">Id </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="id_oper" size="1" width="50">
						<option value="like" <?php if($id_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($id_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="id" size=15 value="{{$id_match}}" onkeypress="javascript: return checkenter(event)"></td>

			
			<td bgcolor="#FFFFFF"><span class="labeltext">Account Name</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="name_oper" size="1" width="50">
						<option value="like" <?php if($name_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($name_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="name" size=15 value="{{$name_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Status </span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="type" size="1" > 
		  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="HOST" <?php if($sval == "HOST"){ echo "selected= 'selectd'"; } ?>>HOST</option>
		  			<option value="VEND" <?php if($sval == "VEND"){ echo "selected= 'selectd'"; } ?>>VEND</option>
		  			<option value="CUST" <?php if($sval == "CUST"){ echo "selected= 'selectd'"; } ?>>CUST</option>
		  		</select>
	  		</span>
			</td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Accounts List</b></span></td>
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
	        <td bgcolor="#EEEFEE"><span class="tabletext"><b>Id</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Account Name</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Industry</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Phone</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>City</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>State</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Country</b></span></td>
	    </tr>

	     @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->id]) !!}">{{ $myrow->id }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->name }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->type }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->industry }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->phone }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->city }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->state }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->country }} </span> </td>
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
