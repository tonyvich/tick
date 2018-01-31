taskManager.factory( 
    'taskGroupsResource', 
    function(
        $http 
    ){
        var factory = {};
        var baseUrl = $("#app_url").val();
        
        /**
         * Get Lists ( Get the connected user taskGroups )
         * @param
         * @return
         */

        factory.get        =  function (){
            return $http.get(baseUrl + "/task-groups");
        };
        
        /**
         * Create (add a taskGroup to the database )
         * @param taskGroup
         * @return json
         */

        factory.create     =  function ( taskGroup ){
            return $http.post(baseUrl + '/task-groups', taskGroup, {headers: {'X-Requested-With': 'XMLHttpRequest' }});
        };

        /**
         * Update ( update taskGroup on database )
         * @param taskGroup
         * @return
         */

        factory.update       =  function ( taskGroup ){
             return $http.put(baseUrl + '/task-groups', taskGroup, {headers: {'X-Requested-With': 'XMLHttpRequest'}});        
        };
        
        /**
         * Delete ( delete taskGroup on database )
         * @param taskGroup
         * @return
         */

        factory.delete       =  function ( taskGroup ){
             return $http.delete(baseUrl + '/task-groups/' + taskGroup.id, {headers: {'X-Requested-With': 'XMLHttpRequest'}});        
        };

        return factory;
    }
);