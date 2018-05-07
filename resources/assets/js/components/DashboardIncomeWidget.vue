<template>
	<div class="panel widget">
	 	<div class="panel-body">
	    	<div class="text-right text-muted">
	       		<em class="fa fa-dollar fa-2x pull-right"></em>
	    	</div>
	    	<h3 class="mt0">
	    		<span class='text-danger' v-if="(total < 0)">{{ total }} {{currency}}</span>
	    		<span class='text-success' v-else>{{ total }} {{currency}}</span>
	    	</h3>
	    	<p class="text-muted">{{ text }}</p>
	    	
	   		<div class="progress progress-xs">
 				 <div 
 				 	class="progress-bar bg-danger" role="progressbar" style="width: 60%" 
 				 	aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
 				 </div>
			</div>

	    </div>
	</div>
</template>

<script>
    export default {
        props: ['total', 'currency', 'text', 'progress'],
        data(){
            return {

            }
        },
    }
</script>
