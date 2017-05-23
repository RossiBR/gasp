<template>
    <div class="container-fluid">
        <div class="row" id="master" v-if="!showDetail">
            <div class="col-md-2">
                  <div class="panel panel-default">
 
                    <div class="panel-body">
    
                        <ul class="nav nav-pills nav-stacked">
                            <li role="presentation" ><a href="#" v-on:click="find(null, null, null, null)">Todos</a></li>
                        </ul>
                </div></div>
            </div>
            <div class="col-md-8">
              <div class="panel panel-default">
 
                    <div class="panel-body">
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li class="active">Cursos</li>
                        </ol>


                        <div class="input-group">
                            <input type="text" id="input-search" class="form-control" placeholder="Buscar..." v-model="search" v-on:keyup.enter="fetch()">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" v-on:click="fetch('nome')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Nome</button>

                                <button class="btn btn-default" type="button" v-on:click="fetch('tipo')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tipo</button>
                            
                                <button class="btn btn-default" type="button" v-on:click="fetch('linha')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Linha</button>
                         
                                <button class="btn btn-default" type="button" v-on:click="fetch('ramo')" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Ramo</button>
                            </span>
                        </div><!-- /input-group -->
                      
                        <br/>
                       
                        <div class="list-group">
                            <button type="button" class="list-group-item" v-for="item in lastResponse.data" v-on:click="detail(item.id)">
                                
                                <strong>{{ item.grade.nome }}</strong>
                                
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
                                <a href="#" v-on:click="sendFile('uploadassociados')" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a><br/><br/>
                                <input type="file" @change="upload" /><br/>
                                <a href="#" v-on:click="sendFile('uploadassociados')" ><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Associados</a><br/>
                                <a href="#" v-on:click="sendFile('uploadims')" ><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> IMS</a><br/>
                                <a href="#" v-on:click="sendFile('uploadformadores')" ><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Formadores</a><br/>                            
                            </div>
                            <div>{{ uploadStatus }}</div>
                </div></div>
            </div>
        </div> <!-- row -->

        <div class="row" id="detail" v-if="showDetail">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <ul class="nav nav-pills nav-stacked">
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(1)">Perfil</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(2)">Dados do Curso</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(3)">Local</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(4)">Equipe</a></li>
                        </ul>
                    </div>
                </div>         
            </div>
            <div class="col-md-8">

                    <div class="panel panel-default">
 
                    <div class="panel-body" id="perfil" v-if="detailPanel == 1" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Cursos</a></li>
                            <li class="active">{{selected.grade.nome}}</li>
                        </ol>
                        
                        <h3>Dados do Curso</h3>
                        <p>Numero: <strong>{{ selected.registro }}</strong></p>

                        <h3>Dados da Grade</h3>
                        <p>Nome: <strong>{{ selected.grade.nome }}</strong></p>
                        <p>Tipo de Curso: <strong>{{ selected.grade.tipo_curso ? selected.grade.tipo_curso.nome : 'N/A'}}</strong></p>
                        <p>Linha de Formação: <strong>{{ selected.grade.linha_formacao ? selected.grade.linha_formacao.nome : 'N/A' }}</strong></p>
                        <p>Ramo: <strong>{{ selected.grade.ramo != null ? selected.grade.ramo.nome : 'N/A' }}</strong></p>

                    </div>

                    <div class="panel-body" id="pessoais" v-if="detailPanel == 2" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Associados</a></li>
                            <li><a href="#" v-on:click="detailPanel(1)">{{selected.grade.nome}}</a></li>
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
                                        v-model="selected.grade.nome" >
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
                            <li><a href="#" v-on:click="master()">Cursos</a></li>
                            <li><a href="#" v-on:click="detailPanel(1)">{{selected.grade.nome}}</a></li>
                            <li class="active">Insígnias da Madeira</li>

                        </ol>
                        
                       
                        
                    </div>

                    <div class="panel-body" id="pessoais" v-if="detailPanel == 4" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">Associados</a></li>
                            <li><a href="#" v-on:click="detailPanel(1)">{{selected.grade.nome}}</a></li>
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
            return { items: [], search: '', lastResponse: {}, selected: {} , ims:{}, debug: '', showDetail: false, edit:false, detailPanel:1, onlyIM:0, ramo: null, linha: null, contrato: null, file: '', isUploading: false, field:'nome', uploadStatus:'' };
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
                
                var resource = this.$resource('api/cursos{/id}');
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
                var resource = this.$resource('api/cursos{/id}');
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
            sendFile: function (target) { 
                let data = new FormData();
                data.append('file', this.file);
                this.$http.post(target, data).then(response => {
                    this.uploadStatus = response.body;
                });
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
