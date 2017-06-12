<template>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="input-nome">{{ label }}</label>
                <div class="input-group">
                    <!-- Button trigger modal -->
                    <span class="input-group-addon" data-toggle="modal" :data-target="modalSelector" @click="fetch">
                        <span class="glyphicon glyphicon-search"></span>
                    </span>                    
                    <input type="text" class="form-control" id="input-nome" placeholder="Nome" aria-describedby="sizing-addon2" 
                        v-model="selected.nome" readonly="readonly">
                    <span class="input-group-addon" @click="add">
                        <span class="glyphicon glyphicon-plus"></span>
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
                            {{ item.nome }} {{ item.sigla ? '('+ item.sigla + ')' : '' }}
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
        props: ['label', 'resource', 'modalLabel', 'selectCallback', 'addCallback', 'current'],
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
                resource.get({search: this.search, field : 'nome'}).then ( response => {
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
                if (this.selectCallback) { 
                    this.selectCallback(this.selected);
                }
            },
            add: function() {                                            
                console.log('add:');
                console.log(this.selected);
                if(this.selected && this.addCallback) {
                    this.addCallback(this.selected);
                    this.selected = {id:null, nome: null};                                
                }
            }
        },
        mounted: function () {
            console.log('Grade Component mounted.');
        }
    }
</script>
