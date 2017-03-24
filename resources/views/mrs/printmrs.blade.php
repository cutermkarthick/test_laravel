
	<?php 
		 $userid = session('user');
		 $dept = session('department');
		 $myrow = $details[0];
	?>

	<table width=100% border=0>
		<tr>
			<td>
				<font style="Arial" size=5><center><b><a href="javascript:window.print()">{{ $myrow->doc_id }}</a></b></center></font>
			</td>
		</tr>
		<tr><td>&nbsp</td></tr>
	</table>

	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>Master Data Details</b></span></td>
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
	</table>

	<table border="1" bgcolor="#DFDEDF" width="100%" cellspacing="1" cellpadding="5" class="table table-bordered">
		<tr bgcolor="#DDDEDD">
			<td colspan=10><span class="heading"><center><b>MRS Notes for Master Routing</b></center></span></td>
		</tr>
		
			@foreach ($linotes as $myrow4notes)
				<tr bgcolor="#FFFFFF">
					<td colspan="4">
					<span class="heading">
						<?php 
							printf("\n");
			              	printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
			              	printf("\n");
			              	printf($myrow4notes->mrsnotes);
			              	printf("   \n");
						?>
					</span>
					</td>
				</tr>
			@endforeach
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

  	<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
		<tr bgcolor="#FFFFFF">
		<td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
		<td colspan=2><span class="labeltext"><?php echo $myrow->formatnum." ".$myrow->formatrev ?></td>
		<td colspan=2><span class="labeltext">Aero Treatments Pvt.Ltd</td>
		</tr>
	</table>