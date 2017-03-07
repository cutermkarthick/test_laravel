@extends('process_sheet.temp')
@section('content')
	<?php 
		 $userid = session('username');
		 $userid = Session::get('username');

		 $myrow = $details[0];
	?>

	<table width=100% cellspacing="0" cellpadding="6" border="0">
		<tr>
			<td>
				<table width=100% border=0 cellspacing="0" cellpadding="0">
					<tr>
						<td><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
						<td align="right">&nbsp; <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
					</tr>
				</table>

				<table width=100% border=0 cellpadding=0 cellspacing=0  >
					<tr><td></td></tr>
					<tr><td></td></tr>
				</table>

				<table width=100% border=0 cellpadding=0 cellspacing=0  >
					<tr bgcolor="DEDFDE">
						<td width="6"><img src="{{ asset('assets/images/spacer.gif') }}" width="6"></td>
							<td bgcolor="#FFFFFF">
								<table width=100% border=0 cellspacing="1" cellpadding="6">
									<tr>
										<td><span class="heading"><b><?php ?>Process Sheet Details</b></span></td>
										<td align="right">

										</td>
									</tr>

									<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
										<tr>
											<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
										</tr>

										<tr bgcolor="#FFFFFF">
											<td><span class="labeltext"><p align="left">*PS #</p></span></td>
											<td  ><span class="tabletext"><?php echo $myrow->bomnum; ?></span></td>
											<td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
											<td ><span class="tabletext"></span></td>
										</tr>

										<tr bgcolor="#FFFFFF">
											<td><span class="labeltext"><p align="left">PS Name</p></font></span></td>
											<td ><span class="tabletext"><?php echo $myrow->type; ?></span></td>
											<td><span class="labeltext"><p align="left">Scope</p></font></span></td>
											<td><span class="tabletext">	</span></td>
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
											<td ><span class="tabletext"></span></td>

										</tr>

										<tr bgcolor="#FFFFFF">
											<td><span class="labeltext"><p align="left">QA Approved By</p></font></span></td>
											<td ><span class="tabletext"><?php echo $myrow->qa_approved_by;?></span></td>
											<td><span class="labeltext"><p align="left">QA Approved Date</p></font></span></td>
											<td ><span class="tabletext"></span></td>
										</tr>

									</table>

					</tr>
				</table>
			</td>
		</tr>
	</table>

@stop