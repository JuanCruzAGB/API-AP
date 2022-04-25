<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">

		<title>{{ $data['from']['name'] }} quiere contactarte</title>
	</head>
	<body>
		<a style="text-align: center; text-decoration: none;" href="{{ env('APP_URL') }}" target="_blank">
			<figure>
				<img src="{{ asset('img/resources/logo/01-regular.png') }}" style=" width: 100%; height: 10rem; object-fit: contain;" alt="Armentia Propiedades logo">
			</figure>
		</a>
		
		<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
			<tr>
				<td style="background-color: #FFFFFF">
					<div style="color: #1C1F22; margin: 4% 10% 2%; text-align: justify; font-family: sans-serif;">
						<h2 style="text-align: center; color: #A39B99; margin: 20px 0;">{{ $data['from']['name'] }} quiere contactarte</h2>
						
						<ul style="font-size: 15px;  margin: 10px 0">
							<li style="list-style: none;"><strong>Se ha contactado:</strong> {{ $data['from']['name'] }} desde tu sitio web.</li>
							
							<li style="list-style: none;"><strong>Email:</strong> {{ $data['from']['email'] }}</li>
							
							<li style="list-style: none;"><strong>Telefono:</strong>  {{ $data['from']['phone'] }}</li>
						</ul>
						
						<p style="margin: 2px; padding-top: 2rem; text-align: center; font-family: sans-serif; font-size: 17px; min-height: 70px; background-color: #FAF4F0; padding: 1rem 1rem; margin-bottom: 2.5rem; ">{{ $data['from']['message'] }}</p>
						
						<p style="color: #FFFFFF; font-size: 1.1rem; text-align:center; margin:30px 0 0; padding: 1rem; background-color: #A39B99; font-family: sans-serif;">© Armentia Propiedades. Todos los Derechos Reservados. | Desarrollado por Archimak</p>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>