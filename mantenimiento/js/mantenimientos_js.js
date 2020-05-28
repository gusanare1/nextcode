var app = angular.module('mantenimiento', []);

//Servicio para compartir funciones entre controladores
app.service('service_atras', function($window) {
this.ir_atras = function()
{
	console.log("Atras");
	$window.history.back();
}
	
});

///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////
///////////////CONFIGURACION////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////


app.controller('configuracion', function($scope, $http, $window, $timeout,service_atras) {
      $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'configuracion_establecimiento':$scope.configuracion_establecimiento, 'configuracion_punto_emision':$scope.configuracion_punto_emision, 'configuracion_sec_factura':$scope.configuracion_sec_factura, 'action':'mantenimiento_configuracion_get'}

    }).then(function successCallback(response) {
	console.log(response.data);
		$scope.configuracion_id = response.data[0].id;
		$scope.configuracion_establecimiento = response.data[0].establecimiento;
		$scope.configuracion_punto_emision = response.data[0].punto_emision;
		$scope.configuracion_sec_factura = response.data[0].sec_factura;


    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });

$scope.atras = function(){
				service_atras.ir_atras();
	};
	
  $scope.enviar = function(service_atras) {
    //$http POST function
	
    $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'id':$scope.configuracion_id, 'establecimiento':$scope.configuracion_establecimiento, 'punto_emision':$scope.configuracion_punto_emision, 'sec_factura':$scope.configuracion_sec_factura, 'action':'mantenimiento_configuracion_put'}

    }).then(function successCallback(response) {
	console.log(response.data);
	  $scope.message = response.data.message;
	  $scope.ver = response.data.sucess;
	  
	  $timeout(function () {
     $scope.ver = !response.data.sucess;
  }, 2000);

    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error al enviar datos!");
    });

  };
});




///////////////////////////////////////////
///////////////////////////////////////////
/////////////////CLIENTES//////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////

app.controller('clientes', function($scope, $http, $log, $window, service_atras) {
 
    $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'action':'mantenimiento_clientes_get'}

    }).then(function successCallback(response) {
	$scope.clientes=response.data;
	console.log($scope.clientes);


    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });
	
	
	$scope.fetchSingleData = function(id){
		$http({
      method: 'POST',
      url: 'mantenimiento.php',
	  data:{'id':id, 'action':'mantenimiento_cliente_fetch_single_data'}

    }).then(function successCallback(response) {
	console.log(response.data.cliente);
	cliente = response.data.cliente[0]
	console.log(cliente.nombre);
	$scope.cliente_id = cliente.id;
	$scope.cliente_identificacion = cliente.identificacion;
	$scope.cliente_nombre = cliente.nombre;	
	$scope.cliente_apellido = cliente.apellido;	
	$scope.cliente_telefono = parseInt(cliente.telefono);	
	fecha = new Date(cliente.emision);
	$scope.cliente_fecha_emision = fecha;	
	$scope.see=true;
	$scope.submit_button = "Editar";
	//$scope.submitForm();
	
    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });
		
	
	};
	
  
  $scope.fetchData = function(){
	  $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'action':'mantenimiento_clientes_get'}

    }).then(function successCallback(response) {
	$scope.clientes=response.data;
	console.log($scope.clientes);


    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });
  };
  


	$scope.addData = function(){
		$scope.see = true;
		$scope.submit_button = "Crear";
		
		$scope.cliente_id = "";
	$scope.cliente_identificacion = "";
	$scope.cliente_nombre ="";	
	$scope.cliente_apellido = "";	
	$scope.cliente_telefono = 0;	
	fecha = new Date();
	$scope.cliente_fecha_emision = fecha;	
	
	
		
		
		//$scope.submitForm();
	};


$scope.atras = function(){
				service_atras.ir_atras();
	};
	
	
	
  
  $scope.submitForm = function() {
    //$http POST function
	console.log($scope.cliente_id);
    $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'action':'mantenimiento_clientes_put', 'cliente_id':$scope.cliente_id, 'cliente_identificacion':$scope.cliente_identificacion, 'cliente_nombre':$scope.cliente_nombre, 'cliente_apellido':$scope.cliente_apellido, 'cliente_telefono':$scope.cliente_telefono, 'cliente_fecha_emision':$scope.cliente_fecha_emision, 'subaction':$scope.submit_button}

    }).then(function successCallback(response) {
	console.log(response.data);
	
	$scope.fetchData();
	$scope.message = response.data.message;
	  
    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });

  };
});




///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////
//////////EMPRESA/////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////


app.controller('empresa', function($scope, $http, $log, $window, service_atras) {
      $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'action':'mantenimiento_empresa_get'}

    }).then(function successCallback(response) {
	console.log(response.data);
		$scope.empresa_id = response.data.resultado[0].id;
		$scope.empresa_nombre = response.data.resultado[0].nombre;
		$scope.empresa_razon_social = response.data.resultado[0].razon_social;
		$scope.empresa_direccion = response.data.resultado[0].direccion;
		$scope.empresa_ruc = response.data.resultado[0].ruc;

    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error getting data!");
    });


$scope.atras = function(){
				service_atras.ir_atras();
	};
	
	
  $scope.enviar = function() {
    //$http POST function
	
    $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'empresa_id':$scope.empresa_id ,'empresa_nombre':$scope.empresa_nombre, 'empresa_razon_social':$scope.empresa_razon_social, 'empresa_direccion':$scope.empresa_direccion, 'empresa_ruc':$scope.empresa_ruc, 'action':'mantenimiento_empresa_put'}

    }).then(function successCallback(response) {
	console.log(response.data);
	  $scope.message = response.data.message;
	  $scope.ver = response.data.sucess;
	  

    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error al enviar datos!");
    });

  };
  
  
  
});

