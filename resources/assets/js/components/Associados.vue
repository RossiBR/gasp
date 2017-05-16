<template>
    <div class="container-fluid">
        <div class="row" id="master" v-if="!showDetail">
            <div class="col-md-2">
                  <div class="panel panel-default">
 
                    <div class="panel-body">
    
                        <ul class="nav nav-pills nav-stacked">
                            <li role="presentation" ><a href="#" v-on:click="find(null, null, null, null)">Todos</a></li>
                            <li role="presentation" ><a href="#" v-on:click="find(1, null, null, null)">IMs</a></li>
                            <li role="presentation" ><a href="#" v-on:click="find(null, null, 1, null)">IM Lobinho</a></li>
                            <li role="presentation" ><a href="#" v-on:click="find(null, null, 2, null)">IM Escoteiro</a></li>
                            <li role="presentation" ><a href="#" v-on:click="find(null, null, 3, null)">IM Sênior</a></li>
                            <li role="presentation" ><a href="#" v-on:click="find(null, null, 4, null)">IM Pioneiro</a></li>
                            <li role="presentation" ><a href="#" v-on:click="find(null, 1, null, null)">IM Dirigente</a></li>
                            <li role="presentation" ><a href="#" v-on:click="findIMContratoValido()">Contrato Válido</a></li>
                            <li role="presentation" ><a href="#" v-on:click="findIMContratoExpirado()">Contrato Expirado</a></li>
                            <li role="presentation" ><a href="#" v-on:click="findIMSemContrato()">Sem Contrato</a></li>
                        </ul>
                </div></div>
            </div>
            <div class="col-md-8">
              <div class="panel panel-default">
 
                    <div class="panel-body">
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li class="active">Associados</li>
                        </ol>


                        <div class="input-group">
                            <input type="text" id="input-search" class="form-control" placeholder="Buscar..." v-model="search" v-on:keyup.enter="fetch()">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" v-on:click="fetch('registro')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Registro</button>
                            
                                <button class="btn btn-default" type="button" v-on:click="fetch('nome')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Nome</button>
                         
                                <button class="btn btn-default" type="button" v-on:click="fetch('uel')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> UEL</button>
                            </span>
                        </div><!-- /input-group -->
                      
                        <br/>
                       
                        <div class="list-group">
                            <button type="button" class="list-group-item" v-for="item in lastResponse.data" v-on:click="detail(item.id)">
                                
                                <strong>{{ item.nome }}</strong>
                                
                                <span class="label label-default pull-right" v-if="item.contratos.length < 1">
                                    Não Possui Contrato
                                </span>
                             
                                <span class="label pull-right" v-bind:class="{'label-info': contractClass(contrato.data_fim) == 1,  'label-warning': contractClass(contrato.data_fim) == 0, 'label-danger': contractClass(contrato.data_fim) == -1}" v-for="contrato in item.contratos">
                                    Contrato válido até {{ contrato.data_fim }}
                                </span>

                                <br/>
                                {{ item.registro }}-{{ item.registro_digito }} G.E. {{ item.uel }} 

                                   
                                <span class="label pull-right" v-bind:class="{'label-warning': (im.ramo_id == 1), 'label-success': (im.ramo_id == 2), 'label-highlight': (im.ramo_id == 3), 'label-danger': (im.ramo_id == 4), 'label-primary': (im.ramo_id == null)}"  v-for="im in item.ims">
                                    IM {{ im.linha_formacao.sigla == 'D' ? im.linha_formacao.nome : '' }}
                                    {{ im.ramo ? im.ramo.nome : '' }}
                                </span>
                                
                            </button>
                        </div> <!-- list -->


                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" v-on:click="prev()">Anterior</button>
                            </div>
                              <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default">{{ lastResponse.from }} até {{ lastResponse.to }} de {{ lastResponse.total }}</button>
                            </div>
                              <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" v-on:click="next()">Proximo</button>
                            </div>
                        </div>
                    </div> <!-- col -->
                    </div></div>
            <div class="col-md-2">
                  <div class="panel panel-default">
 
                    <div class="panel-body">
    
                       
                            <div>
                                <input type="file" @change="upload" />
                                <a href="#" v-on:click="sendFile" ><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Upload</a>                                
                            </div>
    
                </div></div>
            </div>
        </div> <!-- row -->

        <div class="row" id="detail" v-if="showDetail">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <ul class="nav nav-pills nav-stacked">
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(1)">Perfil</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(2)">Dados Pessoais</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(3)">IMs</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(4)">Contrato</a></li>
                        </ul>
                    </div>
                </div>         
            </div>
            <div class="col-md-8">

                    <div class="panel panel-default">
 
                    <div class="panel-body" id="perfil" v-if="detailPanel == 1" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Associados</a></li>
                            <li class="active">{{selected.nome}}</li>
                        </ol>
                        
                        <h3>Dados Pessoais</h3>
                        <p>Registro: <strong>{{ selected.registro }} - {{ selected.registro_digito }}</strong></p>
                        <p>Nome: <strong>{{ selected.nome }}</strong></p>
                        <p>Email: <strong>{{ selected.email }}</strong></p>


                        <h3>Insígnias da Madeira</h3>
                        <p  v-for="im in selected.ims" ><strong>IM {{ im.linha_formacao.sigla == 'D' ? im.linha_formacao.nome : '' }}
                                    {{ im.ramo ? im.ramo.nome : '' }}</strong></p>                       
                    </div>

                    <div class="panel-body" id="pessoais" v-if="detailPanel == 2" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Associados</a></li>
                            <li><a href="#" v-on:click="detailPanel(1)">{{selected.nome}}</a></li>
                            <li class="active">Dados Pessoais</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="input-registro">Registro</label>
                                    <input type="text" class="form-control" id="input-registro" placeholder="Registro" aria-describedby="sizing-addon2" 
                                        v-model="selected.registro">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="input-registro-digito">Digito</label>
                                    <input type="text" class="form-control" id="input-registro-digito" placeholder="Digito" aria-describedby="sizing-addon2" 
                                        v-model="selected.registro_digito">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="input-nome">Nome</label>
                                    <input type="text" class="form-control" id="input-nome" placeholder="Nome" aria-describedby="sizing-addon2" 
                                        v-model="selected.nome" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="input-email">Email</label>
                                    <input type="text" class="form-control" id="input-email" placeholder="Email" aria-describedby="sizing-addon2" 
                                        v-model="selected.email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-created">Data de Criação</label>
                                    <input type="datetime" class="form-control" id="input-created" placeholder="Email" aria-describedby="sizing-addon2" 
                                        v-model="selected.created_at">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-created">Data de Criação</label>
                                    <input type="datetime" class="form-control" id="input-created" placeholder="Email" aria-describedby="sizing-addon2" 
                                        v-model="selected.created_at">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body" id="pessoais" v-if="detailPanel == 3" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Associados</a></li>
                            <li><a href="#" v-on:click="detailPanel(1)">{{selected.nome}}</a></li>
                            <li class="active">Insígnias da Madeira</li>

                        </ol>
                        
                        <p  v-for="im in selected.ims" ><strong>IM {{ im.linha_formacao.sigla == 'D' ? im.linha_formacao.nome : '' }}
                                    {{ im.ramo ? im.ramo.nome : '' }}</strong> {{ im.ano ? im.ano : '' }} <a href="#" v-on:click="deleteim(im.id)">X</a></p>
                        
                    </div>

                    <div class="panel-body" id="pessoais" v-if="detailPanel == 4" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Associados</a></li>
                            <li><a href="#" v-on:click="detailPanel(1)">{{selected.nome}}</a></li>
                            <li class="active">Contratos</li>
                        </ol>
                   

                    </div>


</div>

                </div>
                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div>
                                <a href="#"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Salvar</a>
                            </div>
                            <div>
                                <a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                            </div>
                            <div>
                                <a href="#" v-on:click="master()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Voltar</a>
                            </div>
                            <div>
                                <a href="#" v-on:click="im(1,null)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> IM Dirigente</a>
                            </div>
                            <div>
                                <a href="#" v-on:click="im(2,1)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> IM Ramo Lobinho</a>
                            </div>
                            <div>
                                <a href="#" v-on:click="im(2,2)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> IM Ramo Escoteiro</a>
                            </div>
                            <div>
                                <a href="#" v-on:click="im(2,3)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> IM Ramo Sênior</a>
                            </div>
                            <div>
                                <a href="#" v-on:click="im(2,4)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> IM Ramo Pioneiro</a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
    
    </div> <!-- container -->
</template>

<script>
    export default {
        data: function () {
            return { items: [], search: '', lastResponse: {}, selected: {} , ims:{}, debug: '', showDetail: false, edit:false, detailPanel:1, onlyIM:0, ramo: null, linha: null, contrato: null, file: '', isUploading: false, field:'nome', };
        },
        created: function () {
           this.fetch();
        },
        methods: {
            find: function (im, linha, ramo, contrato) {                
                this.onlyIM=im;
                this.linha=linha;
                this.ramo=ramo;
                this.contrato=contrato;
                this.fetch(); 
            },
            findIMs: function () {
                this.contrato=null;
                this.onlyIM=1;
                this.ramo=null;
                this.linha=null;
                this.fetch(); 
            },
            findIMLobinho: function () {
                this.contrato=null;
                this.onlyIM=0;
                this.ramo=1;
                this.linha=null;
                this.fetch(); 
            },
            findIMEscoteiro: function () {
                this.contrato=null;
                this.onlyIM=0;
                this.ramo=2;
                this.linha=null;
                this.fetch(); 
            },
            findIMSenior: function () {
                this.contrato=null;
                this.onlyIM=0;
                this.ramo=3;
                this.linha=null;
                this.fetch(); 
            },
            findIMPioneiro: function () {
                this.contrato=null;
                this.onlyIM=0;
                this.ramo=4;
                this.linha=null;
                this.fetch(); 
            },
            findIMDirigente: function () {
                this.contrato=null;
                this.onlyIM=0;
                this.ramo=null;
                this.linha=1;
                this.fetch(); 
            },
            findIMContratoValido: function () {
                this.contrato=1;
                this.onlyIM=0;
                this.ramo=null;
                this.linha=null;
                this.fetch(); 
            },
            findIMContratoExpirado: function () {
                this.contrato=2;
                this.onlyIM=0;
                this.ramo=null;
                this.linha=null;
                this.fetch(); 
            },
            findIMSemContrato: function () {
                this.contrato=3;
                this.onlyIM=0;
                this.ramo=null;
                this.linha=null;
                this.fetch(); 
            },
            deleteim: function (im_id) {
                console.log(im_id);
                var resource = this.$resource('insigniamadeira{/id}');
                resource.remove({id: im_id}, {id: im_id}).then ( response => {
                    console.log(this);
                    console.log(response);
                    this.detail(this.selected.id);
                } );                
            },
            showDetailPanel: function (index) {
                this.detailPanel = index;
            },
            im: function (linha_id, ramo_id) {
                var resource = this.$resource('insigniamadeira{/id}');
                resource.save({id:null},{associado_id: this.selected.id, linha_formacao_id: linha_id, ramo_id: ramo_id}).then ( response => {
                        console.log(this);
                        console.log(response);
                        this.detail(this.selected.id);
                }, response => {
                        console.log(this);
                        console.log(response);
                        this.debug = response.body;
                        this.detail(this.selected.id);
                } );
            },
            detail: function(id) {
                console.log(this.search);
                
                var resource = this.$resource('associados{/id}');
                resource.get({id: id}).then ( response => {
                    console.log(this);
                    console.log(response.body);
                    this.selected = {};
                    this.selected = response.body;
                    console.log('selected:');
                    console.log(this.selected);
                } );
                this.showDetail = true;
            },
            master: function() {
                this.fetch();
                this.showDetail = false;
            },
            fetch: function(field) {
                if (field) {
                   this.field = field;
                }
                console.log(this.search);
                var resource = this.$resource('associados{/id}');
                resource.get({field: this.field, search: this.search, im: this.onlyIM, ramo: this.ramo, linha: this.linha, contrato: this.contrato}).then ( response => {
                    console.log(this);
                    console.log(response);
                    this.lastResponse = response.body;
                } );
            },
            next: function() {
                 if (this.lastResponse.next_page_url) {
                     var url = this.lastResponse.next_page_url + "&search=" + this.search + "&field=" + this.field;
                     Vue.http.get(url).then(response => {
                        console.log(this);
                        console.log(response);
                        this.lastResponse = response.body;
                    });
                 }
            },
            prev: function() {
                if (this.lastResponse.prev_page_url) {
                    var url = this.lastResponse.prev_page_url + "&search=" + this.search + "&field=" + this.field;
                    Vue.http.get(this.lastResponse.prev_page_url).then(response => {
                        console.log(this);
                        console.log(response);
                        this.lastResponse = response.body;
                    });
                }
            },
            upload: function (e) {
                e.preventDefault();
                var files = e.target.files;
                this.file = files[0];
            },
            sendFile: function (e) { 
                let data = new FormData();
                data.append('file', this.file);
                this.$http.post('test', data);
            },
            contractClass: function(data_fim) {
                var now = new Date();
                var difDays = Math.ceil(Math.abs(now.getTime() - new Date(data_fim).getTime()) / (1000 * 3600 * 24));
                console.log(difDays);
                if (now > new Date(data_fim)) {
                    return -1;
                }
                
                if (difDays <= 30) {
                    return 0
                }
                return 1;
            }  
            

        },
        mounted: function () {
            console.log('Component mounted.');
        }
    }
</script>
