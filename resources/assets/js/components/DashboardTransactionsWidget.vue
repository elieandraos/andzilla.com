<template>
	<div class="panel widget">
	 	<div class="panel-body">
	    	<div class="text-right text-muted">
	       		<em class="fa fa-shopping-cart fa-2x pull-right"></em>
	    	</div>
	    	<h3 class="mt0">{{ total }}</h3>
	    	<p class="text-muted">{{ text }}</p>
	    	<div style="height:8px;"></div>
	    </div>
	</div>
</template>

<script>
    export default {
        props: ['total', 'text'],
        data(){
            return {

            }
        },
    }
</script>
