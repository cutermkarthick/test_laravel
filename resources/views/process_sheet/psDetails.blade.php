@extends('newtemp.main')
@section('content')
	<?php 
		 $userid = session('user');
		 $myrow = $details[0];
	?>
		<script src="{{ asset('assets/scripts/bom.js') }} "></script>
		<script type="text/javascript">
			var printurl = '{!! route("ps_print", ["recnum" => $myrow->recnum]); !!}';
		</script>
		<table width=100% border=0 cellspacing="0" cellpadding="0" >
			<tr>
				<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
				<td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
			 </tr>
		</table>

		<table width="100%" border="0" cellspacing="1" cellpadding="6">
			<tr>
				<td><span class="heading"><b>Process Sheet Details</b></span></td>
				<td align="right">
					@if($userid  == "atpl" || $userid  == "qa" || $userid  == "eng" || $userid  == "prakash")
						@if($myrow->status == "Pending" || $myrow->status == "Active")
							<a class="btn btn-default" href="{!! route('ps_edit', ['recnum'=> $myrow->recnum]) !!} " role="button">Edit</a>
						@endif
					@endif

					@if($userid  == "atpl")

						@if($myrow->approved == "yes" && $myrow->qa_approved == "yes")
							<a class="btn btn-default" onclick="javascript: printBom({{$myrow->recnum}})"   role="button">Print</a>
						@endif
							<a class="btn btn-default" href="{!! route('ps_copy', ['recnum'=> $myrow->recnum]) !!} " role="button">Copy ps</a>
					@endif

					@if($userid  == "eng" || $userid  == "prakash")
						<a class="btn btn-default" href="{!! route('ps_copy', ['recnum'=> $myrow->recnum]) !!} " role="button">Copy ps</a>
					@endif
    				
				</td>
			</tr>
		</table>

		
		<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
				<tr>
					<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
				</tr>

				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">*PS #</p></span></td>
					<td  ><span class="tabletext"><?php echo $myrow->bomnum; ?></span></td>
					<td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
					<td ><span class="tabletext"> @if($myrow->bomdate != "0000-00-00") {{ Carbon\Carbon::parse($myrow->bomdate)->format('M d, Y') }} @endif</span></td>
				</tr>

				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">PS Name</p></font></span></td>
					<td ><span class="tabletext"><?php echo wordwrap($myrow->type,30,"<br>\n"); ?></span></td>
					<td><span class="labeltext"><p align="left">Scope</p></font></span></td>
					<td><span class="tabletext"><?php echo wordwrap($myrow->bomdescr,30,"<br>\n"); ?></span></td>
				</tr>

				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">Responsibility</p></font></span></td>
					<td colspan=3><span class="tabletext"><?php echo $myrow->fname." ".$myrow->lname ?></span></td>
				</tr>

				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">Status&nbsp;</p></font></span></td>
					<td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow->status;?></span></td>
					<input type="hidden" name="quoterecnum" value="<?php echo $myrow->link2quote ?>">
					<td><span class="labeltext"><p align="left">Issue&nbsp;</p></font></span></td>
					<td ><span class="tabletext"><?php echo $myrow->issue;?></span></td>
				</tr>

				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">Approved By</p></font></span></td>
					<td ><span class="tabletext"><?php echo $myrow->approved_by; ?></span></td>
					<td><span class="labeltext"><p align="left">Approved Date</p></font></span></td>
					<td ><span class="tabletext"> @if($myrow->app_date != "0000-00-00") {{ Carbon\Carbon::parse($myrow->app_date)->format('M d, Y') }} @endif</span></td>

				</tr>

				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">QA Approved By</p></font></span></td>
					<td ><span class="tabletext"><?php echo $myrow->qa_approved_by;?></span></td>
					<td><span class="labeltext"><p align="left">QA Approved Date</p></font></span></td>
					<td ><span class="tabletext"> @if($myrow->qa_app_date != "0000-00-00") {{ Carbon\Carbon::parse($myrow->qa_app_date)->format('M d, Y') }} @endif</span></td>
				</tr>


					<tr bgcolor="#DDDEDD">
						<td colspan=10><span class="heading"><center><b>PS Notes for Process Sheet</b></center></td>
					</tr>
					<tr >
						<td colspan=10>
							<textarea  rows="6" cols="81" readonly="readonly" disabled>
								@foreach ($linotes as $myrow4notes)
									<?php 
										printf("\n");
	                  printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
	                  printf("\n");
	                  printf($myrow4notes->psnotes);
	                  printf("   \n");
									?>
								@endforeach
							</textarea>
						</td>
					</tr>

					<tr bgcolor="#EEEFEE">
						<td colspan=10><span class="heading"><center><b>Process Line Items</b></center></td>
					</tr>

			</table>

			

			<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
				
				<tr>
					<td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Line</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Description</b></span></td>
					<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Subproc </b></span></td>
					<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Tank #</b></span></td>
					<td bgcolor="#EEEFEE" width=7% align="center"><span class="heading"><b>Param<br>Name</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Min</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Max</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty Check</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Paint Check</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Time Check</b></span></td>
					<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Form 2</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Additional Instrns</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Instructions</b></span></td>
				</tr>

				

				@foreach ($lidetails as $myrowli)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext">{{ $myrowli->line_num }}</span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  <?php echo wordwrap($myrowli->item_desc,30,"<br>\n")?> </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->item_value }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->tank_num }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->item_name }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->optemp_min }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->optemp_max }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->qty_check }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->paint_check }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->time_check }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->form2 }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  <?php echo wordwrap($myrowli->workcenter,30,"<br>\n")?> </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  <?php echo wordwrap($myrowli->comments,30,"<br>\n")?> </span> </td>
		    </tr>
		    @endforeach
		  </table>

@stop