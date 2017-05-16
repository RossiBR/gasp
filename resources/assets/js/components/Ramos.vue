<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    
                    <!-- title -->
                    <div class="panel-heading">Ramos</div>
                    
                    <!-- content -->
                    <div class="panel-body">
                        <div class="list-group">
                                <button type="button" class="list-group-item" v-for="item in lastResponse.data">
                                    {{ item.nome }} ({{ item.sigla }})
                                </button>
                            </div> <!-- list -->

                    </div> <!-- body -->

                </div> <!-- panel -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container -->
</template>

<script>
    export default {
        data: function () {
            return { items: [], search: '', lastResponse: {} };
        },
        created: function () {
           this.fetch();
        },
        methods: {
            fetch: function() {
                console.log(this.search);
                var resource = this.$resource('ramos{/id}');
                resource.get({search: this.search}).then ( response => {
                    console.log(this);
                    console.log(response);
                    this.lastResponse = response.body;
                } );
            }
        },
        mounted: function () {
            console.log('Component mounted.');
        }
    }
</script>
