<template>
     <table class="table table-hover">
        <thead>
            <tr>
                <th class="fixed-width-m">Amount</th>
                <th class="fixed-width-m">Date</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="transaction in transactions" id="transactions-body">
                <td class='fixed-width-m'>
                    <span class="amount" :class="(transaction.debit) ? 'bg-success' : 'bg-danger'">
                        <i class="fa" :class="(transaction.debit) ? 'fa-arrow-up' : 'fa-arrow-down'"></i>
                        {{ transaction.amount}}
                    </span>
                </td>
                <td class="fixed-width-m due-at">{{ transaction.due_at }}</td>
                <td class="transaction-title text-info">
                    {{ transaction.title }}
                    <p class="subtablecell">
                        <i :class="transaction.category_icon"></i>
                        {{ transaction.category_name }}
                    </p>
                </td>
                <td class="row-actions" v-touch:swipe="handleTouchEvents" v-touch-class="'touch-active'">
                    <ul>
                        <li>
                            <a class="btn btn-info btn-xs" :href="transaction.edit_url">Edit</a>
                        </li>
                    </ul>
                </td>
            </tr>
            <infinite-loading @infinite="infiniteHandler"></infinite-loading>
        </tbody>
    </table>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import axios from 'axios';
    import Helper from './../mixins/Helper.js';

    export default {
        components: { InfiniteLoading },
        mixins: [ Helper ],
        data(){
            return {
                transactions: [],
                payload: [],
                link: '',
                total: 0,
            }
        },
        mounted() {
           
        },
        methods: {
            /*
             * Hanldes the infinite loading scroll
             *  
             */
            infiniteHandler($state) {
                var _url;
                const vm = this;

                // get the request url
                if(this.link)
                    _url = this.link;
                else
                    _url = '/transactions/fetch';

                // run the request
                axios.post(_url, this.payload)
                    .then(function(response){
                        response = response.data;
                        var _data = response.data;
                        if(_data.length){
                            if(!vm.transactions.length)
                                vm.transactions = _data;
                            else
                                vm.transactions = vm.transactions.concat(_data);
                            
                            if(vm.object_has(response, 'links.next'))
                                vm.link = response.links.next;
                            if(vm.object_has(response, 'meta.total'))
                                vm.total = response.meta.total;

                             // set the infinite state to loaded
                            $state.loaded();

                            // do dom update after the data is reflected
                            vm.$nextTick(() => {
                               
                            });

                            // set the state to complete when all the results are loaded.
                            if (vm.total == vm.transactions.length || vm.total == 0) {
                                $state.complete();
                            }
                        }
                        else{
                            $state.complete();
                        }

                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },
            handleTouchEvents(direction)
            {
              alert(direction);
            } 
        }
    }
</script>
