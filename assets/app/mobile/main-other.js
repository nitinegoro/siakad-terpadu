/*
* @author Vicky Nitinegoro	
* @package Angular Js
*/

'use strict';


app.controller('newsCtrl', function($scope, $filter, $http, $location) 
{
	$scope.wrapper = false;

	$scope.loading = true;


	$http({
		    method:'GET',
		    url: base_url + "/news/data?per_page=&page=" ,
		    data : $scope.data,
		    headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then( function ( response ) 
		{
		if( response.data.status === "failed") 
		{
			Materialize.toast('Maaf! data tidak tersedia.', 2000, 'rounded red', function() {
				$scope.wrapper = false; 
			});
		} else if(response.data.status === "success") {
			$scope.wrapper = true; 
			$scope.results = response.data.results;
		}
	},function ( response ) {
		Materialize.toast('Maaf! terjadi kesalahan saat mengambil data.', 2000, 'rounded red', function() {
			window.location.reload();
		});
	}).finally(function() {
		// called no matter success or failure
		$scope.loading = false;
	});
});



app.controller('getnewsCtrl', function($scope, $http, $location) 
{
	$scope.wrapper = false;

	$scope.loading = true;

	$http({
		    method:'GET',
		    url: base_url + "/news/data/5" ,
		    data : $scope.data,
		    headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then( function ( response ) 
		{
		if( response.data.status === "failed") 
		{
			Materialize.toast('Maaf! data tidak tersedia.', 2000, 'rounded red', function() {
				$scope.wrapper = false; 
			});
		} else if(response.data.status === "success") {
			$scope.wrapper = true; 
			$scope.results = response.data.results;
		}
	},function ( response ) {
		Materialize.toast('Maaf! terjadi kesalahan saat mengambil data.', 2000, 'rounded red', function() {
			window.location.reload();
		});
	}).finally(function() {
		// called no matter success or failure
		$scope.loading = false;
	});
})