var app = angular.module('mantenimiento', []);
app.controller('configuracion', function($scope, $http, $log, $window) {
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

	
	
	
	
	
	
  $scope.enviar = function() {
    //$http POST function
	
    $http({
      method: 'POST',
      url: 'mantenimiento.php',
      data: {'id':$scope.configuracion_id, 'establecimiento':$scope.configuracion_establecimiento, 'punto_emision':$scope.configuracion_punto_emision, 'sec_factura':$scope.configuracion_sec_factura, 'action':'mantenimiento_configuracion_put'}

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

app.controller('clientes', function($scope, $http, $log, $window) {
  
  
  $scope.submitForm = function() {
    //$http POST function
	
    $http({
      method: 'POST',
      url: 'login.php',
      data: {'username':$scope.usuario_username, 'password':$scope.usuario_password, 'action':'login'}

    }).then(function successCallback(response) {
	console.log(response.data);
	  $scope.errores = response.data.error;
	  if(!response.data.sucess)
	  {
		  $scope.bool_errores = true;
		  
		  
	  }
	  else
	  {
		  $window.location.href = "index.php";
	  }
	  
	  
    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });

  };
});

  