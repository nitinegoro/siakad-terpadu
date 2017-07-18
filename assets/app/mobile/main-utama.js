/*
* @author Vicky Nitinegoro	
* @package Angular Js
*/

(function () {
    'use strict';

    // Lihat Jadwal Mata Kuliah
	app.controller('scheduleCtrl', function($scope, $http, $location) 
	{
		$scope.loading = true;

		$scope.datajadwal = false; 
		
		$http({
		       method:'GET',
		       url: base_url + "/schedule/getschedule",
		       data : $scope.data,
		       headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		   }).then( function ( response ) 
			{
			if( response.data.status === "failed") 
			{
				Materialize.toast('Maaf! data jadwal tidak tersedia.', 2000, 'rounded red', function() {
					 $scope.datajadwal = false; 
				});
			} else if(response.data.status === "success") {
				$scope.datajadwal = true; 

				$scope.schedule = response.data.schedule;
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

	// Hasil Stdudi Controller
	app.controller('lihatkhsCtrl', function($scope, $http, $location) 
	{
		$scope.loading = false; 

		$scope.data = {
			semester: "",
			thnakademik: ""
		};

		$scope.getkhsdata = function() 
		{
			$scope.loading = true;

			$scope.datakhs = false; 
			
			if($scope.data.semester === "") 
			{
				$scope.semestererror = true;
			} else {
				$scope.semestererror = false;
			}

			if($scope.data.thnakademik === "") 
			{
				$scope.thakademikerror = true;
			} else {
				$scope.thakademikerror = false;
			}

			$http({
		        method:'POST',
		        url: base_url + "/point/khsdata",
		        data : $scope.data,
		        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).then( function ( response ) 
			{
				if( response.data.status === "failed") 
				{
					Materialize.toast('Maaf! data nilai tidak tersedia.', 2000, 'rounded red', function() {
					 	window.location.reload();
					});
				} else if(response.data.status === "success") {
					$scope.datakhs = true; 

					$scope.khs = response.data;
				}
				
			},function ( response ) {
				Materialize.toast('Maaf! terjadi kesalahan saat mengambil data.', 2000, 'rounded red', function() {
					 window.location.reload();
				});
			}).finally(function() {
			    // called no matter success or failure
				$scope.loading = false;
			});
		} 
	});

	// Rencana Studi Controller
	app.controller('lihatkrsCtrl', function($scope, $http, $location) 
	{
		$scope.loading = false; 

		$scope.data = {
			semester: "",
			thnakademik: ""
		};

		$scope.getkrsdata = function() 
		{
			$scope.loading = true;

			$scope.datakrs = false; 
			
			if($scope.data.semester === "") 
			{
				$scope.semestererror = true;
			} else {
				$scope.semestererror = false;
			}

			if($scope.data.thnakademik === "") 
			{
				$scope.thakademikerror = true;
			} else {
				$scope.thakademikerror = false;
			}

			$http({
		        method:'POST',
		        url: base_url + "/plain/getplain",
		        data : $scope.data,
		        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).then( function ( response ) 
			{
				if( response.data.status === "failed") 
				{
					Materialize.toast('Maaf! data nilai tidak tersedia.', 2000, 'rounded red', function() {
					 	window.location.reload();
					});
				} else if(response.data.status === "success") {
					$scope.datakrs = true; 

					$scope.krs = response.data;
				}
			},function ( response ) {
				Materialize.toast('Maaf! terjadi kesalahan saat mengambil data.', 2000, 'rounded red', function() {
					 window.location.reload();
				});
			}).finally(function() {
				$scope.loading = false;
			});
		} 
	});


	app.controller('susunkrsCtrl', function($scope, $filter, $http, $location) 
	{
		$scope.loading = true; 
		$scope.count = 0;
		$scope.data = {
			semester: "",
			thnakademik: "",
			totalsks:""
		};

		$scope.count = 0;

		$http({
		       method:'GET',
		       url: base_url + "/plain/getmk",
		       headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then( function ( response ) 
		{
			if( response.data.status === "failed") 
			{
				Materialize.toast('Maaf! data nilai tidak tersedia.', 2000, 'rounded red', function() {
					 window.location.reload();
				});
			} else if(response.data.status === "success") {

				$scope.loading = false;

				var courses = [];

				angular.forEach(response.data.results, function(value, key) 
				{
				   	courses.push({
				   		id: value.course_id, 
				   		text:value.course_name,
				   		sks:value.sks,
				   		code:value.course_code
				   	});
				});

				$scope.courses = courses;
			}
				
		},function ( response ) {
			Materialize.toast('Maaf! terjadi kesalahan saat mengambil data.', 2000, 'rounded red', function() {
				window.location.reload();
			});
		}).finally(function() {
			   // called no matter success or failure
			$scope.loading = false;
		});

		$scope.mkChanged = function(e, item) 
		{
			if($scope.data.mk[item].selected === true) 
			{
				$scope.count += $(e.target).data('sks');
		   	} else {
		    	$scope.count -= $(e.target).data('sks');
		   	}

		   	$scope.data.totalsks = $scope.count;
		}

		$scope.createkrs = function() 
		{
			$scope.loading = true;
			
			if($scope.data.semester === "") 
			{
				$scope.semestererror = true;
			} else {
				$scope.semestererror = false;
			}

			if($scope.data.thnakademik === "") 
			{
				$scope.thakademikerror = true;
			} else {
				$scope.thakademikerror = false;
			}

			$http({
		        method:'POST',
		        url: base_url + "/plain/setkrs",
		        data : $scope.data,
		        headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).then( function ( response ) 
			{
				if( response.data.status === "failed") 
				{
					Materialize.toast( response.data.message , 4000, 'rounded red', function() {
					 	window.location.reload();
					});
				} else if(response.data.status === "success") {
					Materialize.toast( response.data.message , 4000, 'rounded red', function() {
					 	window.location.href = '../../mobile/main';
					});
				}
				
			},function ( response ) {
				Materialize.toast('Maaf! terjadi kesalahan saat mengirim data.', 2000, 'rounded red', function() {
					 window.location.reload();
				});
			}).finally(function() {
			    // called no matter success or failure
				$scope.loading = false;
			});
		}
	});

}());