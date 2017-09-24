app.factory("myfactory",($http,$q)=>{
    var object =  {
        callserver : function(obj){
            console.log(obj);
            var pr = $q.defer();
			var url = "https://api.halanx.com/rest-auth/login/";
            console.log(obj);
			$http.post(url,obj).then(function(data){
				pr.resolve(data.data);
				console.log("Token",data.data.key);

                var token = JSON.stringify(data.data.key);
                localStorage.setItem('token', token);
            
			});

            return pr.promise;
				}
				}
    return object;
			});
