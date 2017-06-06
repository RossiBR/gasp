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
                            <li class="active">{{ this.model_label }}</li>
                        </ol>

                        <div class="alert alert-danger alert-dismissible" role="alert" v-if="errorMessage">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          {{ errorMessage }}
                        </div>


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
                                
                                <strong>{{ item.grade ? item.grade.nome : 'Novo Curso' }}</strong>
                                
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
                                <a href="#" v-on:click="newItem()" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a><br/><br/>
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
                            <li role="presentation" v-if="selected.id"><a href="#" v-on:click="showDetailPanel(1)">Resumo</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(2)">Dados</a></li>
                            <li role="presentation"><a href="#" v-on:click="showDetailPanel(3)" v-if="selected.id">Equipe</a></li>
                            <li role="presentation" v-if="selected.id"><a href="#" v-on:click="showDetailPanel(4)">Grade</a></li>
                        </ul>
                    </div>
                </div>         
            </div>
            <div class="col-md-8">

                    <div class="panel panel-default">
 
                    <transition name="fade">
                    <div class="panel-body" id="perfil" v-if="detailPanel == 1" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">{{ this.model_label }}</a></li>
                            <li class="active">{{ selected.id ? selected.grade.nome : 'Novo Curso'}}</li>
                        </ol>
                        
                        <h3>Dados do Curso</h3>
                        <p>Numero: <strong>{{ selected.id ? selected.numero : null }}</strong></p>

                        <h3>Dados da Grade</h3>
                        <p>Nome: <strong>{{ selected.grade ? selected.grade.nome : 'Novo Curso' }}</strong></p>
                        <p>Tipo de Curso: <strong>{{ selected.grade && selected.grade.tipo_curso != null ? selected.grade.tipo_curso.nome : 'N/A'}}</strong></p>
                        <p>Linha de Formação: <strong>{{ selected.grade && selected.grade.linha_formacao != null ? selected.grade.linha_formacao.nome : 'N/A' }}</strong></p>
                        <p>Ramo: <strong>{{ selected.grade && selected.grade.ramo != null ? selected.grade.ramo.nome  : 'N/A' }}</strong></p>

                    </div>
                    </transition>
            
                    <div class="panel-body" id="pessoais" v-if="detailPanel == 2" >
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">{{ this.model_label }}</a></li>
                            <li><a href="#" v-on:click="showDetailPanel(1)">{{ selected.grade ? selected.grade.nome : 'Novo Curso'}}</a></li>
                            <li class="active">Dados do Curso</li>
                        </ol>                                

                        <input-select label="Grade" resource="grades" modalLabel="Grades" :select-callback="updateGrade" :current="selected.grade" />

                        <input-select label="Local" resource="locais" modalLabel="Locais" :select-callback="updateLocal" :current="selected.local" />

                        <input-select label="Distrito" resource="distritos" modalLabel="Distritos" :select-callback="updateDistrito" :current="selected.distrito"/>

                        <input-timestamps :created-at="selected.created_at" :updated-at="selected.updated_at" />

                    </div>
                    <div class="panel-body" id="pessoais" v-if="detailPanel == 3">
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">{{ this.model_label }}</a></li>
                            <li><a href="#" v-on:click="showDetailPanel(1)">{{selected.grade.nome}}</a></li>
                            <li class="active">Insígnias da Madeira</li>

                        </ol>
                        
                       
                        
                    </div>

                    <div class="panel-body" id="pessoais" v-if="detailPanel == 4">
    
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li><a href="#" v-on:click="master()">{{ this.model_label }}</a></li>
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
                                <a href="#" @click="save()"><span class="glyphicon glyphicon-save" aria-hidden="true" ></span> Salvar</a>
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
        props: ['model_type', 'model_label'],

        data: function () {
            return {
                errorMessage: null,
                resource_url: '', 
                items: [], 
                
                search: '', 
                field:'nome',

                lastResponse: {}, 
                
                selected: {}, 
                

                debug: '', 
                showDetail: false, 
                
                edit:false, 
                 
                detailPanel:1,
                file: '', 
                isUploading: false, 
                uploadStatus:'',

                ims:{}, onlyIM:0, ramo: null, linha: null, contrato: null,  
                result1: null,
            };
        },

        created: function () {
            this.resource_url = 'api/' + this.model_type + '{/id}';
            this.fetch();
            
            
            
        },

        methods: {

            formatDatetime: function(datetime) {
              if (datetime === null) {
                return "[null]";
              } else {
                return datetime.format("YYYY-MM-DD HH:mm:ss");
              }
            },
            newItem: function() {
                this.selected = {id: null, grade: null, created_at: null, updated_at: null};
                this.showDetail=true;
                this.showDetailPanel(2);
            },
            save: function() {
                var resource = this.$resource(this.resource_url);
                if (this.selected.id) {
                    resource.update({id:this.selected.id},{
                        grade_id: this.selected.grade.id, 
                        local_id: (this.selected.local ? this.selected.local.id : null),
                        distrito_id: (this.selected.distrito ? this.selected.distrito.id : null),
                    }).then ( response => {
                            console.log('saved:')
                            console.log(this);
                            console.log(response);
                            this.selected = response.body;
                            this.detail(this.selected.id);
                    }, response => {
                            console.log(this);
                            console.log(response);
                            this.debug = response.body;
                            this.errorMessage = response.body;
                    } );
                } else {
                    resource.save({id:null},{
                        grade_id: this.selected.grade.id, 
                        local_id: (this.selected.local ? this.selected.local.id : null),
                        distrito_id: (this.selected.distrito ? this.selected.distrito.id : null),
                    }).then ( response => {
                            console.log('saved:')
                            console.log(this);
                            console.log(response);
                            this.selected = response.body;
                            this.detail(this.selected.id);
                    }, response => {
                            console.log(this);
                            console.log(response);
                            this.debug = response.body;
                            this.errorMessage = response.body;
                    } );
                }
            },
            find: function (im, linha, ramo, contrato) {                
                this.onlyIM=im;
                this.linha=linha;
                this.ramo=ramo;
                this.contrato=contrato;
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
            updateGrade: function(grade) {
                this.selected.grade_id = grade.id;
                this.selected.grade = grade;
            },
            updateLocal: function(local) {
                this.selected.local_id = local.id;
                this.selected.local = local;
            },
            updateDistrito: function(distrito) {
                this.selected.distrito_id = distrito.id;
                this.selected.distrito = distrito;
            },
            detail: function(id) {
                console.log(this.search);
                
                var resource = this.$resource(this.resource_url);
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
                var resource = this.$resource(this.resource_url);
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
        },        
    }
</script>
