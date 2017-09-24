app.factory("myfactory", ($http, $q) => {
	var obj = {
		arr: [],
		callserver: function () {
			var pr = $q.defer();
			var url = "https://api.halanx.com/users/getotp/"+ obj.username + "/";


			$http.get(url).then(function (data) {
				pr.resolve(data.data)
				

			},
				function (err) {
					pr.reject(err)
					console.log("error")

				}
			)
			return pr.promise
		}
	}
	return obj;
})