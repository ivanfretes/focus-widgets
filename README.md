## Framework codeigniter-super ##



### Widget ###
	* Para crear widget, se crean vacios por defecto, con el fin de llamar con JS, y que el usuario ya lo pueda editar.
	* Para editar los elementos, se editan uno a uno, para evitar procesar todo el formulario sin ninguna necesidad
	* Existe un controlador widget que genera las vista de todos
	* Para cada widget existe un controlador que crea y edita los campos, debido a que estos, tienen caracteristicas distintas.
	* No olvidar que para cada widget, pueden haber n items en otra subtabla, el ejemplo de ello es un widget slide, que tiene 5 registros, cada uno representa una imagen, pero forman a un solo widget
	* El nombre de las vistas, functiones, y modelos es similar, por no decir igual, recordar esto.


Widget Creados hasta el momento
	* Slide: Conjunto de 5 Imagenes, con o sin miniaturas
	* Cuadricula: Conjunto de n cantidad de imagenes
	* Row : Fila hasta con dos columnas, que puede variar su orientacion






