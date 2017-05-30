<template>
    <div class="form-group">
        <label for="input-created">{{ label }}</label>
        <div class="input-group date" :id="internalId" v-on:mouseover="hover" >
            <input type="text" class="form-control" v-model="value" v-on:change="change" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>                            
</template>

<script>
    export default {
        props: ['label', 'field', 'updateCallback'],
        data: function () {
            return { internalId: null, init: true, value: null};
        },
        created: function () {
            this.internalId = 'datetimepicker' + this.field;
            this.selector = '#' + this.internalId;
        },
        mounted: function () {
            
        },        
        updated: function () {
            console.log('DateTime Component updated.');
        },
        methods: {
            change: function () {
                this.updateCallback()
            },
            hover: function () {
                if(this.init) {
                    //$(document).ready( function () {
                        $(this.selector).datetimepicker({
                            locale:'pt-br'
                        });
                    //});
                    this.init = false;
                }
            }          
        },
        
    }
</script>
