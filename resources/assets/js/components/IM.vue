<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Associados</div>

                    <div class="panel-body">
                        <div class="list-group">
                            <button type="button" class="list-group-item" v-for="item in items">
                                {{ item.nome }}<br/>
                                {{ item.registro }}-{{ item.registro_digito }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return { items: [] };
        },
        created: function () {
           this.fetch();
        },
        methods: {
            fetch: function() {
                var resource = this.$resource('im{/id}');
                resource.get().then ( response => {
                    console.log(this);
                    console.log(response);
                    this.items = response.body;
                } );
            }
        },
        mounted: function () {
            console.log('Component mounted.');
        }
    }
</script>
