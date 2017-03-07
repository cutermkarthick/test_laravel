<!DOCTYPE html>
<html>
<head>
	<title>summary</title>
</head>
<body>

<a href="{!! route('addnew') !!}">ADD</a>


<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
	<tr>
		<td>Seq #</td>
		<td>Username</td>
		<td>Email</td>
		<td>Address</td>
		<td>Phone</td>
		<td>Action</td>
	</tr>

	@foreach ($udata as $myrow)
		<tr bgcolor="#FFFFFF" >
          <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('edit_user', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></td>
          <td bgcolor="#FFFFFF"><span class="tabletext">{{ $myrow->username }}</td>
          <td bgcolor="#FFFFFF"><span class="tabletext">{{ $myrow->email }}</td>
          <td bgcolor="#FFFFFF"><span class="tabletext">{{ $myrow->address }}</td>
          <td bgcolor="#FFFFFF"><span class="tabletext">{{ $myrow->phone }}</td>
          <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('delete_user', ['recnum'=> $myrow->recnum]) !!}"><img src="{{ asset('assets/img/delete.png') }}"></a></td>

          </tr>
	@endforeach

</table>

</body>
</html>