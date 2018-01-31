taskManager.factory( 
    'usersResource', 
    function(
        $http 
    ){
        var factory = {};
        var baseUrl = $("#app_url").val();

        /**
         * Get Users
         * @param
         * @return
         */

        factory.get        =  function (){
            return $http.get(baseUrl + "/users");
        };
        
        /**
         * Update ( update user role on database )
         * @param user
         * @return
         */

        factory.update       =  function ( user ){
             return $http.put(baseUrl + '/users/role', user, {headers: {'X-Requested-With': 'XMLHttpRequest'}});        
        };

        return factory;
    }
);