var app = angular.module('productos', []);

//Servicio para compartir funciones entre controladores
app.service('service_atras', function($window) {
this.ir_atras = function()
{
	console.log("Atras");
	$window.history.back();
}
	
});


app.controller('producto', function($scope, $http, $window, $timeout,service_atras) {
      $http({
      method: 'POST',
      url: 'producto.php',
      data: {'action':'mantenimiento_productos_get'}

    }).then(function successCallback(response) {
	console.log(response.data);
		$scope.productos = response.data.productos;

    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error getting productos!");
    });
	
	$scope.getAllProductos = function()
	{
		
		$http({
      method: 'POST',
      url: 'producto.php',
      data: {'action':'mantenimiento_productos_get'}

    }).then(function successCallback(response) {
	console.log(response.data);
		$scope.productos = response.data.productos;

    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error getting productos!");
    });
	
	};
	
	$scope.fetchProducto = function(id){
		$http({
      method: 'POST',
      url: 'producto.php',
      data: {'id':id, 'action':'mantenimiento_productos_get_producto'}

    }).then(function successCallback(response) {
	console.log(response.data);
		producto = response.data.productos;
		$scope.producto_id = producto[0].id;
		$scope.producto_nombre = producto[0].nombre;
		$scope.producto_codigo = producto[0].codigo;
		$scope.producto_descripcion = producto[0].descripcion;
		$scope.producto_precio_unitario = parseInt(producto[0].precio_unitario);
		$scope.producto_cantidad_disponible_stock = parseInt(producto[0].cantidad_disponible);

		$scope.ver_form=true;
		$scope.submit_text="Modificar";

    }, function errorCallback(response) { 
		console.log(response);
      alert("Error. Error getting productos!");
    });
	}

	$scope.addProducto = function()
	{
		$scope.ver_form = true;
		$scope.producto_id = "";
		$scope.producto_nombre = "";
		$scope.producto_codigo = "";
		$scope.producto_descripcion = "";
		$scope.producto_precio_unitario = 0;
		$scope.submit_text = "Crear";
		$scope.producto_cantidad_disponible_stock = 0;
	}
	
$scope.atras = function(){
				service_atras.ir_atras();
	};
	
  $scope.enviar = function(service_atras) {
    //$http POST function
	console.log($scope.producto_cantidad_disponible_stock);
    $http({
      method: 'POST',
      url: 'producto.php',
      data: {'producto_id':$scope.producto_id, 'producto_nombre':$scope.producto_nombre, 'producto_codigo':$scope.producto_codigo, 'producto_descripcion':$scope.producto_descripcion, 'producto_precio_unitario':$scope.producto_precio_unitario, "cantidad_disponible":$scope.producto_cantidad_disponible_stock ,'action':"mantenimiento_productos_put" ,'subaction':$scope.submit_text}

    }).then(function successCallback(response) {
	console.log(response.data);
	  $scope.message = response.data.message;
	  $scope.ver = response.data.sucess;
	  $timeout(function () {
     $scope.ver = !response.data.sucess;
  }, 2000);

  $scope.getAllProductos();
  
    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error al enviar datos!");
    });

  };
});