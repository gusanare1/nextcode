var app = angular.module('Login', []);
app.controller('usuario', function($scope, $http, $log, $window) {
  
  
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
		  $window.location.href = "../index.php";
	  }
	  
	  
    }, function errorCallback(response) {
		console.log(response);
      alert("Error. Error login!");
    });

  };
  
  
  	
  });
