export default {
    methods: {
    	/*
    	 * Like hasOwnProperty prototype js method, but with deep checking
    	 */
    	object_has(obj, propertyPath){
    		 if(!propertyPath)
		        return false;

		    var properties = propertyPath.split('.');

		    for (var i = 0; i < properties.length; i++) {
		        var prop = properties[i];

		        if(!obj || !obj.hasOwnProperty(prop)){
		            return false;
		        } else {
		            obj = obj[prop];
		        }
		    }

		    return true;
    	},
    	/*
    	 * Like php's array_unique()
    	 */
    	array_unique(_array){
            var unique = [];
            for (var i = 0; i < _array.length; i++) {
                if (unique.indexOf(_array[i]) == -1) {
                    unique.push(_array[i]);
                }
            }
            return unique;
        },
        /*
         * Generates a unique id.
         */
        randId(){
             return Math.random().toString(36).substr(2, 10);
        }
	}
}