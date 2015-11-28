jQuery(document).ready(function($){

	$(document).snowFlurry({
        maxSize: sf_variable.maxSize,
        numberOfFlakes: sf_variable.numberOfFlakes,
        minSpeed: sf_variable.minSpeed,
        maxSpeed: sf_variable.maxSpeed,
        color: sf_variable.color,
        timeout: sf_variable.timeout
    });

});
