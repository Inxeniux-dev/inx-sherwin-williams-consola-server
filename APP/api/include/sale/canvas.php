<?php 

	// Imagen base64 enviada desde javascript en el formulario
	// En este caso, con PHP plano podriamos obtenerla usando :
	$baseFromJavascript = $_POST['base64'];

	// Remover la parte de la cadena de texto que no necesitamos (data:image/png;base64,)
	// y usar base64_decode para obtener la información binaria de la imagen
	$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));


	// Proporciona una locación a la nueva imagen (con el nombre y formato especifico)
	$filepath = "C:\Pruebas\image.png"; // or image.jpg

	// Finalmente guarda la imágen en el directorio especificado y con la informacion dada
	file_put_contents($filepath, $data);

?>