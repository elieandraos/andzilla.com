<template>
	<div class="panel widget">
	 	<div class="panel-body">
	    	<div class="text-right text-muted">
	       		<em :class="icon + ' fa-2x pull-right' "></em>
	    	</div>
	    	<h3 class="mt0">{{ category }}</h3>
	    	<p class="text-muted" v-html="text"></p>
	    	<div style="height:8px;"></div>
	    </div>
	</div>
</template>

<script>
    export default {
        props: ['category', 'text', 'icon'],
        data(){
            return {

            }
        },
    }
</script>
