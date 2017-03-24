@extends('newtemp.main')
@section('content')

	<?php 

		// if (($myrow->ppc_app_date != "0000-00-00") &&  ($myrow->ppc_app_date != "") && ($myrow->ppc_app_date != NULL) ) {
		// 	echo "if";
		// }
		// else
		// {
		// 	echo "else";
		// }
	?>

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
					@if($dept == 'Sales' || $dept == "QAS" || $dept == 'ENG')
						@if($myrow->status == "Pending" || $myrow->status == "Active")
							<a class="btn btn-default" href="{!! route('pin_edit', ['recnum'=> $myrow->recnum]) !!} " role="button">Edit</a>
						@endif
					@endif

					@if($dept == 'Sales'  || $dept == 'ENG')
						<a class="btn btn-default" href="{!! route('pin_copy', ['recnum'=> $myrow->recnum]) !!} " role="button">Copy</a>
					@endif
    				
				</td>
			</tr>
		</table>
	<br>

	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
			<tr>
				<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
			</tr>

			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left">PIN</p></span></td>
				<td  ><span class="tabletext"><?php echo $myrow->CIM_refnum; ?></span></td>
				<td><span class="labeltext"><p align="left">Type</p></font></span></td>
				<td ><span class="tabletext">{{ $myrow->pin_type }}</span></td>
			</tr>

			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">MR#</p></span></td>
            <td><span class="tabletext">{{ $myrow->bomnum }} </td>
            <td width=25%><span class="labeltext"><p align="left">MR Issue</p></font></td>
            <td><span class="tabletext"><span class="tabletext">{{ $myrow->mrissue }} </td>
            </td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=25%><span class="tabletext"><?php echo wordwrap($myrow->partname,50,"<br>\n");  ?>
            </td>
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->partnum,50,"<br>\n"); ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Issue</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->part_issue,50,"<br>\n");  ?></td>

            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->attachments,50,"<br>\n");  ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->customer,50,"<br>\n");  ?>
            </td>
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->project,50,"<br>\n");  ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->drawing_num,50,"<br>\n");  ?>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->drg_issue,50,"<br>\n");  ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->rm_type,50,"<br>\n");  ?></td>
            <td><span class="labeltext"><p align="left">Specification</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->rm_spec,50,"<br>\n");  ?></td>
        </tr>
        
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS Iss</p></font></td>
            <td><textarea cols="40" rows ="4" readonly="readonly" ><?php  echo $myrow->cos ?></textarea></td>
            <td><span class="labeltext"><p align="left">Part List</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->part_list,50,"<br>\n");  ?></td>
         </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td bgcolor="#00FF00" ><span class="tabletext"> {{$myrow->status}} </td>
            <td colspan="2"></td>

         </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Technique Sheet No</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->tech_sheet_no,50,"<br>\n");  ?></td>
            <td><span class="labeltext"><p align="left">Technique Sheet Iss</p></font></td>
            <td><span class="tabletext"><?php echo wordwrap($myrow->tech_sheet_issue,50,"<br>\n");  ?></td>
         </tr>         

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Approved</p></font></td>
            <td><span class="tabletext"><p align="left">{{$myrow->ppc_approved}} </td>
            <td><span class="labeltext"><p align="left">Approved Date</p></font></td>
            <td colspan=3><span class="tabletext"><p align="left">@if(($myrow->ppc_app_date != "0000-00-00") &&  ($myrow->ppc_app_date != "") ) {{ Carbon\Carbon::parse($myrow->ppc_app_date)->format('M d, Y') }} @endif </td>
        </tr>        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">QA Approved</p></font></td>
            <td><span class="tabletext"><p align="left">{{$myrow->qa_approved}} </td>
            <td><span class="labeltext"><p align="left">QA Approved Date </p></font></td>
            <td colspan=3><span class="tabletext"><p align="left">@if( ($myrow->qa_app_date != "0000-00-00") && ($myrow->qa_app_date != "") ) {{ Carbon\Carbon::parse($myrow->qa_app_date)->format('M d, Y') }} @endif </td>
        </tr> 


       	<tr bgcolor="#DDDEDD">
						<td colspan=10><span class="heading"><center><b>Pin Master Notes</b></center></td>
					</tr>
					<tr >
						<td colspan=10>
							<textarea  rows="6" cols="81" readonly="readonly" disabled>
								@if(!empty($notes))
									@foreach ($notes as $myrow4notes)
										<?php 
											printf("\n");
		                  printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
		                  printf("\n");
		                  printf($myrow4notes->pin_notes);
		                  printf("   \n");
										?>
									@endforeach
								@endif
							</textarea>
						</td>
					</tr>

					<tr bgcolor="#EEEFEE">
						<td colspan=10><span class="heading"><center><b>Master Routing Flow</b></center></td>
					</tr>

	</table>

		<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
				
				<tr>
					<td bgcolor="#EEEFEE" width=3% align="center"><span class="heading"><b>Line Num</b></span></td>
					<td bgcolor="#EEEFEE" width=5% align="center"><span class="heading"><b>OP No</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Description </b></span></td>
					<td bgcolor="#EEEFEE" width=5% align="center"><span class="heading"><b>PS NO</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Spec</b></span></td>
					<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Std Iss</b></span></td>
					<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Dept</b></span></td>

				</tr>

				

				@foreach ($lidetails as $myrowli)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"> {{ $myrowli->linenum }}</span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->op_num }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->desc }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->ps_no }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->spec }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->std_iss_ref }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->dept }} </span> </td>


		    </tr>
		    @endforeach
	  </table>

@stop