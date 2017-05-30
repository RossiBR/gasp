<template>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="input-nome">{{ label }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="input-nome" placeholder="Nome" aria-describedby="sizing-addon2" 
                        v-model="selected.nome" readonly="readonly">
                        <!-- Button trigger modal -->
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search" data-toggle="modal" :data-target="modalSelector" @click="fetch"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ modalLabel }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            <button type="button" class="list-group-item" v-for="item in lastResponse.data" data-dismiss="modal" @click="select(item)">
                            {{ item.nome }} ({{ item.sigla }})
                            </button>
                        </div> <!-- list -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                                
                    </div>
                </div>
            </div>
        </div>
    </div>      
</template>

<script>
    export default {
        props: ['label', 'resource', 'modalLabel', 'selectCallback', 'current'],
        data: function () {
            return { inputId:'', modalId:'', modalSelector: '', resourceUrl: '', items: [], search: '', lastResponse: {data:null}, selected: {id:null, nome:null} };
        },
        created: function () {
            this.modalId = 'modal'+this.modalLabel;
            this.modalSelector = '#'+this.modalId;
            this.inputId = 'input'+this.label;
            this.resourceUrl = 'api/'+ this.resource + '{/id}';
            if (this.current) {
                this.selected = this.current;
            }
        },
        methods: {            
            fetch: function() {
                console.log(this.search);
                var resource = this.$resource(this.resourceUrl);
                resource.get({search: this.search}).then ( response => {
                    console.log(this);
                    console.log(response);
                    if (response.body.data) {
                        this.lastResponse = response.body;
                    } else {
                        this.lastResponse.data = response.body;
                    }
                } );
            },
            select: function(item) {                            
                this.selected = item;
                console.log('selected:');
                console.log(this.selected);
                this.selectCallback(this.selected);
            },
        },
        mounted: function () {
            console.log('Grade Component mounted.');
        }
    }
</script>
