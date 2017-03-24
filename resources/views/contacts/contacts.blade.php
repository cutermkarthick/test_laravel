@extends('newtemp.main')
@section('content')

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	{!!  Form::open(['url'=>'contacts' , 'class'=>'form', 'method' => 'post']) !!}

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

			
			<td bgcolor="#FFFFFF"><span class="labeltext">First Name</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="fname_oper" size="1" width="50">
						<option value="like" <?php if($fname_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($fname_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="fname" size=15 value="{{$fname_match}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Last Name</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="lname_oper" size="1" width="50">
						<option value="like" <?php if($lname_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($lname_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="lname" size=15 value="{{$lname_match}}" onkeypress="javascript: return checkenter(event)"></td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Contacts List</b></span></td>
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
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>First Name</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Last Name</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Email</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Title</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Role</b></span></td>
			<td bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
	    </tr>

	    @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->contactid]) !!}">{{ $myrow->contactid }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->fname }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->lname }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->name }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->email }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->type }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->title }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->role }} </span> </td>
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