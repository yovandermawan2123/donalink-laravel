<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h4>Campaign : {{ $campaign->name }}</h4>
    <br>
		<h6>{{ $campaign->start_date . ' - ' . $campaign->end_date }}</h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Invoice</th>
				<th>Donatur</th>
				<th>Jumlah Donasi</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($donations as $donation)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $donation->invoice_number }}</td>
				<td>{{ $donation->user->name }}</td>
				<td>{{ rupiah($donation->amount) }}</td>
				<td>{{ $donation->status }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>