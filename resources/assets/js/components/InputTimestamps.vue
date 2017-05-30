<template>
    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-created">Data de Criação</label>
                                    <input type="datetime" class="form-control" id="input-created" placeholder="Created At" aria-describedby="sizing-addon2" 
                                        v-model="createdAt" readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-created">Data de Criação</label>
                                    <input type="datetime" class="form-control" id="input-created" placeholder="Updated At" aria-describedby="sizing-addon2" 
                                        v-model="updatedAt" readonly="readonly">
                                </div>
                            </div>
                        </div>
</template>

<script>
    export default {
        props: ['createdAt', 'updatedAt'],
        data: function () {
            return {  };
        },
        created: function () {
            
        },        
        mounted: function () {
            console.log('Timestamps Component mounted.');
        },
        methods: {            
            
        },
        
    }
</script>
