<template>
    <div class='transactions-filter clearfix'>
        <!-- results count -->
        <span id="filter-count" class="badge pull-right" data-toggle="tooltip" title="Total transactions" v-if="total">{{ total }}</span>

        <!-- Categories filter -->
        <select 
            multiple='multiple' data-selected-text-format='count > 1' title='Categories' data-live-search="true"
            class='selectpicker pull-right' name='categories[]' id='categories-filter'
            v-if="loaded" v-model="payload.categories"
        >
            <option v-for="(category, id) in categories" :value="id"> {{ category }}</option>
        </select>

        <!-- Date range filter -->
        <div id="reportrange" class="pull-right">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp; Date range&nbsp;
            <span id='range-value' v-model="payload.date"></span> <b class="caret"></b>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from "moment";

    import Helper from './../mixins/Helper.js';

    export default {
        props: ['total'],
        mixins: [ Helper ],
        data(){
            return {
                categories: [],
                loaded: false,
                payload: {
                    categories: [],
                    date: null,
                }

            }
        },
        mounted() {
           this.initDateRangePicker();
           this.fetchUserCategories();
        },
        watch: {
            payload: {
                handler: function(value) {
                    // whenever the payload change, run the filter request by emitting an event to the parent component
                    this.$parent.$emit('doFilter', this.payload);
                },
                deep: true
            },
        },
        methods: {
            /*
             * Initialize the jquery daterange picker plugin
             */
            initDateRangePicker()
            {
                const vm = this;
                $('#reportrange').daterangepicker({
                    ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    locale: {
                        format: 'DD/MMM/YYYY'
                    },
                    autoApply: true,
                }, function cb(start, end) {
                    let startDate = start.format('MMMM D, YYYY');
                    let endDate = end.format('MMMM D, YYYY');
                    vm.payload.date = startDate + ' - ' + endDate;
                    // v-model of 'selectedDate' is weirdly not reactive, so i had to do it manual
                    $('#reportrange span').html(startDate + ' - ' + endDate);
                });
            },
            /*
             * Get the user defined categories
             */
            fetchUserCategories(direction)
            {
                const vm = this;

                axios.post('/transactions/categories')
                    .then(function(response){
                        vm.categories = response.data.categories;
                        vm.loaded = true;
                        // update the dom after the data changes are applied
                        vm.$nextTick(() => {
                             $("#categories-filter").selectpicker('render');
                        });
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },
        }
    }
</script>
