@extends('process_sheet.temp')
@section('content')



	<?php 
		 $userid = session('username');
		 $userid = Session::get('username');

	?>
	<table width=100% cellspacing="0" cellpadding="6" border="0">
		<tr>
			<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
				<tr>
					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
				 </tr>
			</table>

			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr bgcolor="DEDFDE">
					<td width="6"><img src="{{ asset('assets/images/spacer.gif') }} " width="6"></td>
					<td bgcolor="#FFFFFF">
						<table width=100% border=0 cellpadding=6 cellspacing=0>
						<tr><td><span class="heading"><i>Please click on the PS link for details or to Edit/Delete</i></span></td></tr>

						<tr>
  						<td>

  							<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
									<tr>
										<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></span></td>
										<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></span></td>
										<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext"><input type= "image" name="Get" src="{{ asset('assets/images/bu-get.gif') }}" value="Get" onclick="javascript: return searchsort_fields()"></td>
									</tr>

									<tr>
										<td bgcolor="#FFFFFF"><span class="labeltext">PS #</span></td>
										<td bgcolor="#FFFFFF">
											<span class="tabletext">
												<select name="oper" size="1" width="50">
													<option value="like" >Like</option>
													<option value="=" >=</option>
												</select>
											</span>
										</td>
										<td bgcolor="#FFFFFF"><input type="text" name="bom" size=15 value="" onkeypress="javascript: return checkenter(event)"></td>

										<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b></span></td>
										<td bgcolor="#FFFFFF" colspan=3>
											<span class="tabletext">
									  		<select name="condition" size="1" > 
									  			<option value="All" >All</option>
									  			<option value="Active" >Active</option>
									  			<option value="Pending" >Pending</option>
									  			<option value="Inactive" >Inactive</option>
									  			<option value="Cancelled" >Cancelled</option>
									  		</select>
								  		</span>
										</td>
									</tr>
								</table>
  						</td>
  					</tr>

  				<tr>
  					<td><span class="pageheading"><b>List of Process sheets</b></span></td>
  				</tr>

  				<tr>
  					<td>
  						<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" >
						    <tr>
						        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>PS #</b></span></td>
						        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Iss #</b></span></td>
						        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Date</b></span></td>
						        <td width="50%" bgcolor="#EEEFEE"><span class="heading"><b>Description</b></span></td>
						        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Responsibility</b></span></td>
						        <td width="10%" bgcolor="#EEEFEE"><span class="heading"><b>Status</b></span></td>
						    </tr>

						    
						    @foreach ($results as $myrow)
					    	<tr>
							    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('ps_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->bomnum }}</a></span> </td>
							    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->issue }} </span> </td>
							    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->psdate }} </span> </td>
							    <td bgcolor="#FFFFFF"><span class="tabletext">   <?php echo wordwrap($myrow->bomdescr,60,"<br>\n")?> </span> </td>
							    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->fname }} </span> </td>
							    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
						    </tr>
						    @endforeach
						  </table>

  					</td>	
  				</tr>
				</table>
					</td>
					<td width="6"><img src="{{ asset('assets/images/spacer.gif') }}  " width="6"></td>
				</tr>

				<tr bgcolor="DEDFDE">
					<td width="6"><img src="{{ asset('assets/images/box-left-bottom.gif') }}"></td>
					<td><img src="{{ asset('assets/images/spacer.gif') }} " height="6"></td>
					<td width="6"><img src="{{ asset('assets/images/box-right-bottom.gif') }}"></td>
				</tr>
			</table>

			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
				<tr>
				  <td align=left></td>
				</tr>

	</table>


@stop