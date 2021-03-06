@extends('newtemp.main')
@section('content')
	<?php 
		 $userid = session('user');
		 $dept = session('department');
		 $myrow = $details[0];
	?>

	<script src="{{ asset('assets/scripts/master_route.js') }} "></script>
	<script type="text/javascript">
		var printurl = '{!! route("mrs_print", ["recnum" => $myrow->recnum]); !!}';
	</script>
	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>Master Routing Details</b></span></td>
			<td align="right">
				@if($userid == "atpl" || $dept == "QAS" || $dept == "ENG")
					@if($myrow->status =="Pending" || $myrow->status =="Active")
						<a class="btn btn-default" href="{!! route('mrs_edit', ['recnum'=> $myrow->recnum]) !!}" role="button">Edit</a>
					@endif
				@endif
				
				@if($userid == "atpl")
					<a class="btn btn-default" onclick="javascript: printRoute_master({{$myrow->recnum}})"   role="button">Print</a>
				@endif

				@if($userid == "atpl"  || $dept == "ENG")
					<a class="btn btn-default" href="{!! route('mrs_copy', ['recnum'=> $myrow->recnum]) !!}" role="button">Copy MRS</a>
				@endif
			</td>
		</tr>
	</table>

	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">DOC ID</p></span></td>
			<td  ><span class="tabletext"><?php echo $myrow->doc_id; ?></span></td>
			<td><span class="labeltext"><p align="left">Issue</p></font></span></td>
			<td ><span class="tabletext">{{ $myrow->issue }}</span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">OEM</p></font></span></td>
			<td ><span class="tabletext"> {{ $myrow->customer }} </span></td>
			<td><span class="labeltext"><p align="left">Date</p></font></span></td>
			<td><span class="tabletext">@if($myrow->date != "0000-00-00") {{ Carbon\Carbon::parse($myrow->date)->format('M d, Y') }} @endif</span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">Scope</p></font></span></td>
			<td ><span class="tabletext"><?php echo wordwrap($myrow->scope,30,"<br>\n"); ?></span></td>
			<td><span class="labeltext"><p align="left">Responsibility</p></font></span></td>
			<td ><span class="tabletext">{{ $myrow->response }}</span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">Reference&nbsp;</p></font></span></td>
			<td ><span class="tabletext">{{ $myrow->reference }}</span></td>
			<input type="hidden" name="quoterecnum" value="">
			<td bgcolor="#00FF00"><span class="labeltext"><p align="left">Status&nbsp;</p></font></span></td>
			<td ><span class="tabletext">{{ $myrow->status }}</span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">Approved By</p></font></span></td>
			<td ><span class="tabletext"><?php echo $myrow->approved_by; ?></span></td>
			<td><span class="labeltext"><p align="left">Approved Date</p></font></span></td>
			<td ><span class="tabletext">@if($myrow->approved_date != "0000-00-00") {{ Carbon\Carbon::parse($myrow->approved_date)->format('M d, Y') }} @endif </span></td>

		</tr>

		


			<tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>MRS Notes for Master Routing</b></center></td>
			</tr>
			<tr >
				<td colspan=10>
					<textarea  rows="6" cols="81" readonly="readonly" disabled>
						@foreach ($linotes as $myrow4notes)
							<?php 
								printf("\n");
              printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
              printf("\n");
              printf($myrow4notes->mrsnotes);
              printf("   \n");
							?>
						@endforeach
					</textarea>
				</td>
			</tr>
	</table>

			<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
				<tr bgcolor="#EEEFEE">
					<td colspan=10><span class="heading"><center><b>MRS Revision History</b></center></td>
				</tr>

				<tr>
					<td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Rev #</b></span></td>
					<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Rev Date</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Descriptions </b></span></td>
					<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Owner</b></span></td>
					<td bgcolor="#EEEFEE" width=7% align="center"><span class="heading"><b>Approved By</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Approved Date</b></span></td>
				</tr>

				@if(!empty($rev_his))
					@foreach ($rev_his as $rev)
	  			<tr>
						<td bgcolor="#FFFFFF"><span class="tabletext">  {{ $rev->rev_num }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  @if($rev->rev_date != "0000-00-00") {{ Carbon\Carbon::parse($rev->rev_date)->format('M d, Y') }} @endif  </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $rev->desc }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $rev->owner }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $rev->approved_by }} </span> </td>
				    <td bgcolor="#FFFFFF"><span class="tabletext">  @if($rev->approved_date != "0000-00-00") {{ Carbon\Carbon::parse($rev->approved_date)->format('M d, Y') }} @endif  </span> </td>
	  			</tr>
	  			@endforeach
	  		@endif

			</table>

		<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
			<tr bgcolor="#EEEFEE">
				<td colspan=10><span class="heading"><center><b>MRS Line Items</b></center></td>
			</tr>

		<tr>
			<td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Line Num</b></span></td>
			<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>OP NO</b></span></td>
			<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Descriptions </b></span></td>
			<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Spec</b></span></td>
			<td bgcolor="#EEEFEE" width=7% align="center"><span class="heading"><b>Std Iss</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>PS NO</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>PS Iss #</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Cofc Display</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Dept</b></span></td>
		</tr>

		

		@foreach ($lidetails as $myrowli)
  		<tr>
		    <td bgcolor="#FFFFFF"><span class="tabletext">{{ $myrowli->linenum }}</span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->op_num }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  <?php echo wordwrap($myrowli->desc,30,"<br>\n")?> </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->spec }}  </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->std_iss_ref }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->ps_no }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->ps_issue }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->display }} </span> </td>
		    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->dept }} </span> </td>
    	</tr>
    	@endforeach
  </table>


@stop