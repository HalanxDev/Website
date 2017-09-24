app.factory("myfactory", ($http, $q) => {
    var object = {
        callserver: function () {
            var pr = $q.defer();
            var url = "https://api.halanx.com/stores/";

            var key = "";

            $http.get(url).then(function (data) {
                    pr.resolve(data.data)
                    console.log("success")

                },
                function (err) {
                    pr.reject(err)
                    console.log("error")

                }

            )
            return pr.promise

        },
        save: function (id) {
            var json = JSON.stringify(id)
            localStorage.setItem('storeid', json);
        },
        storelist: function (store) {
            var pr = $q.defer();
            var url = "https://api.halanx.com/stores/search/"+store;


            $http.get(url).then(function (data) {
                    pr.resolve(data.data.hits.hits)
                    console.log("success")

                },
                function (err) {
                    pr.reject(err)
                    console.log("error")

                }
            )
            return pr.promise
        }
    }

    return object;
})
