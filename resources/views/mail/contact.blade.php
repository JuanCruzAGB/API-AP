<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>{{ $data->name }} quiere contactarte</title>
	</head>
	<body>
		<img src="{{ asset('img/resources/logo/logo_Regular.png') }}" style=" width: 100%; height: 10rem; object-fit: contain;" alt="Mutualcoop">
		<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
			<tr>
				<td style="background-color: #fff">
					<div style="color: #1C1F22; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
						<h2 style="text-align: center; color: #a39b99;margin: 20px 0;">{{ $data->name }} quiere contactarte</h2>
						<ul style="font-size: 15px;  margin: 10px 0">
							<li style="list-style: none;"><strong>Se ha contactado:</strong> {{ $data->name }} desde tu sitio web.</li>
							<li style="list-style: none;"><strong>Email:</strong> {{ $data->email }}</li>
							<li style="list-style: none;"><strong>Telefono:</strong>  {{ $data->phone }}</li>
						</ul>
						<p style="margin: 2px;padding-top: 2rem;text-align: center;font-family: sans-serif;font-size: 17px;min-height: 70px;background-color: #faf4f0;padding: 1rem 1rem;margin-bottom: 2.5rem;">{{ $data->message }}</p>
						<p style="color: #ffffff;font-size: 1.1rem;text-align:center;margin:30px 0 0;padding: 1rem;background-color: #a39b99;font-family: sans-serif;">© Armentia Propiedades. Todos los Derechos Reservados. | Desarrollado por Archimak</p>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>